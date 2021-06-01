<?php

class QueryPrepare
{
    public $conn;

    function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function prepare($query,$type,...$params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($type,...$params);
        return $stmt;
    }
}

class Admin extends QueryPrepare
{
    public $id,$username,$password;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->password = $data["password"];
    }
    
    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM admin WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function loginAdmin()
    {
        $q = $this->prepare(
            "SELECT * FROM admin WHERE username = ? AND password = ?",
            "ss",
            $this->username,$this->password
        );
        $q->execute();
        $r = $q->get_result();
        $data = $r->fetch_assoc();
        $this->getDataByID($data["id"]);
        
        if ($data)
        {
            return [
                "status"=>"success",
                "result"=>$data
            ];
        }

        return [
            "status"=>"fail"
        ];
    }
}

class User extends QueryPrepare
{
    public $id,$name,$password,$email,$address,$phone;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->password = $data["password"];
        $this->email = $data["email"];
        $this->address = $data["address"];
        $this->phone = $data["phone"];
    }

    function checkUsernameExist($username)
    {
        $q = $this->prepare(
            "SELECT * FROM user WHERE name = ?",
            "s",
            $username
        );
        $q->execute();
        $r = $q->get_result();
        $data = $r->fetch_assoc();
        return ($data != null) ? true:false;
    }
    
    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM user WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function editUser()
    {
        $q = $this->prepare(
            "UPDATE user SET name=?,email=?,password=?,address=?,phone=? WHERE id = ?",
            "sssssi",
            $this->name,$this->email,md5($this->password),$this->address,$this->phone,$this->id
        );
        $q->execute();
        $this->getDataByID($this->id);
        return $q;
    }

    function registerUser()
    {
        $q = $this->prepare(
            "INSERT INTO user (name,email,password,address,phone) VALUES (?,?,?,?,?)",
            "sssss",
            $this->name,$this->email,md5($this->password),$this->address,$this->phone
        );
        $q->execute();
        $r = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function loginWithEmail()
    {
        $q = $this->prepare(
            "SELECT * FROM user WHERE email = ? AND password = ?",
            "ss",
            $this->email,md5($this->password)
        );
        $q->execute();
        $r = $q->get_result();
        $data = $r->fetch_assoc();
        
        $this->getDataByID($data["id"]);

        if ($data)
        {
            return [
                "status"=>"success",
                "result"=>$data
            ];
        }

        return [
            "status"=>"fail"
        ];
    }
}

class TempatWisata extends QueryPrepare
{
    public $id,$nama_tempat,$alamat,$harga;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->nama_tempat = $data["nama_tempat"];
        $this->alamat = $data["alamat"];
        $this->harga = $data["harga"];
        $this->foto = $data["foto"];
    }

    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM tempat_wisata WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function add()
    {
        $q = $this->prepare(
            "INSERT INTO tempat_wisata (nama_tempat,alamat,harga,foto) VALUES (?,?,?,?)",
            "ssis",
            $this->nama_tempat,
            $this->alamat,
            $this->harga,
            $this->foto
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE tempat_wisata SET nama_tempat = ?, alamat = ?, harga = ?, foto = ? WHERE id = ?",
            "ssisi",
            $this->nama_tempat,$this->alamat,$this->harga,$this->foto,$this->id
        );
        $q->execute();
    }

    function delete()
    {
        $q = $this->prepare(
            "DELETE FROM tempat_wisata WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll()
    {
        $data = $this->conn->query("SELECT * FROM tempat_wisata");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new TempatWisata($this->conn);
            $dd->id = $d["id"];
            $dd->nama_tempat = $d["nama_tempat"];
            $dd->alamat = $d["alamat"];
            $dd->harga = $d["harga"];
            $dd->foto = $d["foto"];
            array_push($r,$dd);
        }
        return $r;
    }
    
    function getRandom($limit = 3)
    {
        $data = $this->conn->query("SELECT * FROM tempat_wisata ORDER BY RAND() LIMIT $limit");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new TempatWisata($this->conn);
            $dd->id = $d["id"];
            $dd->nama_tempat = $d["nama_tempat"];
            $dd->alamat = $d["alamat"];
            $dd->harga = $d["harga"];
            $dd->foto = $d["foto"];
            array_push($r,$dd);
        }
        return $r;
    }

    function searchAlamat($alamat)
    {
        $q = $this->prepare(
            "SELECT * FROM tempat_wisata WHERE alamat LIKE ?",
            "s",
            "%".$alamat."%"
        );
        $q->execute();
        $r = $q->get_result();
        return $r;
    }

    function searchNamaTempat($nama_tempat)
    {
        $q = $this->prepare(
            "SELECT * FROM tempat_wisata WHERE nama_tempat LIKE ?",
            "s",
            "%".$nama_tempat."%"
        );
        $q->execute();
        $r = $q->get_result();
        return $r;
    }

}

class Penginapan extends QueryPrepare
{
    public $id,$nama_tempat,$alamat;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->nama_tempat = $data["nama_tempat"];
        $this->alamat = $data["alamat"];
        $this->foto = $data["foto"];
    }

    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM penginapan WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function add()
    {
        $q = $this->prepare(
            "INSERT INTO penginapan (nama_tempat,alamat,foto) VALUES (?,?,?)",
            "sss",
            $this->nama_tempat,
            $this->alamat,
            $this->foto
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE penginapan SET nama_tempat = ?, alamat = ?, foto = ? WHERE id = ?",
            "sssi",
            $this->nama_tempat,$this->alamat,$this->foto,$this->id
        );
        $q->execute();
    }

    function delete()
    {
        $q = $this->prepare(
            "DELETE FROM penginapan WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll()
    {
        $data = $this->conn->query("SELECT * FROM penginapan");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new Penginapan($this->conn);
            $dd->id = $d["id"];
            $dd->nama_tempat = $d["nama_tempat"];
            $dd->alamat = $d["alamat"];
            $dd->foto = $d["foto"];
            array_push($r,$dd);
        }
        return $r;
    }

    function getRandom($limit = 3)
    {
        $data = $this->conn->query("SELECT * FROM penginapan ORDER BY RAND() LIMIT $limit");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new Penginapan($this->conn);
            $dd->id = $d["id"];
            $dd->nama_tempat = $d["nama_tempat"];
            $dd->alamat = $d["alamat"];
            $dd->foto = $d["foto"];
            array_push($r,$dd);
        }
        return $r;
    }

    function searchAlamat($alamat)
    {
        $q = $this->prepare(
            "SELECT * FROM penginapan WHERE alamat LIKE ?",
            "s",
            "%".$alamat."%"
        );
        $q->execute();
        $r = $q->get_result();
        return $r;
    }
}

class Kamar extends QueryPrepare
{
    public $id,$penginapan_id,$no_kamar,$harga;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->penginapan_id = $data["penginapan_id"];
        $this->no_kamar = $data["no_kamar"];
        $this->harga = $data["harga"];
    }

    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM kamar WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function add()
    {
        $q = $this->prepare(
            "INSERT INTO kamar (penginapan_id,no_kamar,harga) VALUES (?,?,?)",
            "iii",
            $this->penginapan_id,
            $this->no_kamar,
            $this->harga
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE kamar SET penginapan_id = ?, no_kamar = ?, harga = ? WHERE id = ?",
            "iiii",
            $this->penginapan_id,
            $this->no_kamar,
            $this->harga,
            $this->id
        );
        $q->execute();
    }

    function delete()
    {
        $q = $this->prepare(
            "DELETE FROM kamar WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll()
    {
        $data = $this->conn->query("SELECT * FROM kamar");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new Kamar($this->conn);
            $dd->id = $d["id"];
            $dd->penginapan_id = $d["penginapan_id"];
            $dd->no_kamar = $d["no_kamar"];
            $dd->harga = $d["harga"];
            array_push($r,$dd);
        }
        return $r;
    }
}

class MetodePembayaran extends QueryPrepare
{
    public $id,$nama,$no_rek,$atas_nama;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->no_rek = $data["no_rek"];
        $this->atas_nama = $data["atas_nama"];
    }

    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM metode_pembayaran WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function add()
    {
        $q = $this->prepare(
            "INSERT INTO metode_pembayaran (nama,no_rek,atas_nama) VALUES (?,?,?)",
            "sss",
            $this->nama,
            $this->no_rek,
            $this->atas_nama
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE metode_pembayaran SET nama = ?, no_rek = ?, atas_nama = ? WHERE id = ?",
            "sssi",
            $this->nama,
            $this->no_rek,
            $this->atas_nama,
            $this->id
        );
        $q->execute();
    }

    function delete()
    {
        $q = $this->prepare(
            "DELETE FROM metode_pembayaran WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll()
    {
        $data = $this->conn->query("SELECT * FROM metode_pembayaran");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new MetodePembayaran($this->conn);
            $dd->id = $d["id"];
            $dd->nama = $d["nama"];
            $dd->atas_nama = $d["atas_nama"];
            $dd->no_rek = $d["no_rek"];
            array_push($r,$dd);
        }
        return $r;
    }
}

class TiketWisata extends QueryPrepare
{
    public $id,$user_id,$wisata_id,$total_tiket,$total_harga;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->wisata_id = $data["wisata_id"];
        $this->total_tiket = $data["total_tiket"];
        $this->total_harga = $data["total_harga"];
    }

    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM tiketwisata WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function add()
    {
        $q = $this->prepare(
            "INSERT INTO tiketwisata (user_id,wisata_id,total_tiket,total_harga) VALUES (?,?,?,?)",
            "iiii",
            $this->user_id,
            $this->wisata_id,
            $this->total_tiket,
            $this->total_harga,
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE tiketwisata SET user_id = ?, wisata_id = ?, total_tiket = ?, total_harga = ? WHERE id = ?",
            "iiiii",
            $this->user_id,
            $this->wisata_id,
            $this->total_tiket,
            $this->total_harga,
            $this->id
        );
        $q->execute();
    }

    function delete()
    {
        $q = $this->prepare(
            "DELETE FROM tiketwisata WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll()
    {
        $data = $this->conn->query("SELECT * FROM tiketwisata");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new TiketWisata($this->conn);
            $dd->id = $d["id"];
            $dd->user_id = $d["user_id"];
            $dd->wisata_id = $d["wisata_id"];
            $dd->total_tiket = $d["total_tiket"];
            $dd->total_harga = $d["total_harga"];
            array_push($r,$dd);
        }
        return $r;
    }
}

class StatusPembayaran
{
    public static $foto_belum_dikirim = 0;
    public static $menunggu_approval_admin = 1;
    public static $pembayaran_berhasil = 2;
    public static $pembayaran_ditolak = 3;
}

class Pembayaran extends QueryPrepare
{
    public $id,$tiket_id,$book_id,$total_harga,$metode_pembayaran,$status,$foto_bukti;
    
    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->tiket_id = $data["tiket_id"];
        $this->book_id = $data["book_id"];
        $this->total_harga = $data["total_harga"];
        $this->metode_pembayaran = $data["metode_pembayaran"];
        $this->status = $data["status"];
        $this->foto_bukti = $data["foto_bukti"];
    }

    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM pembayaran WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function add()
    {
        $q = $this->prepare(
            "INSERT INTO pembayaran (tiket_id,book_id,total_harga,metode_pembayaran) VALUES (?,?,?,?)",
            "iiii",
            $this->tiket_id,
            $this->book_id,
            $this->total_harga,
            $this->metode_pembayaran,
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE pembayaran SET tiket_id = ?, book_id = ?, total_harga = ?, metode_pembayaran = ?, status = ?, foto_bukti = ? WHERE id = ?",
            "iiiiisi",
            $this->tiket_id,
            $this->book_id,
            $this->total_harga,
            $this->metode_pembayaran,
            $this->status,
            $this->foto_bukti,
            $this->id
        );
        $q->execute();
    }

    function delete()
    {
        $q = $this->prepare(
            "DELETE FROM pembayaran WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll()
    {
        $data = $this->conn->query("SELECT * FROM pembayaran");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new TiketWisata($this->conn);
            $dd->id = $d["id"];
            $dd->tiket_id = $d["tiket_id"];
            $dd->book_id = $d["book_id"];
            $dd->total_harga = $d["total_harga"];
            $dd->metode_pembayaran = $d["metode_pembayaran"];
            $dd->status = $d["status"];
            $dd->foto_bukti = $d["foto_bukti"];
            array_push($r,$dd);
        }
        return $r;
    }

    function getPembayaranByUserId($user_id)
    {
        $data = $this->conn->query("SELECT * FROM pembayaran");
        $r = [];
        foreach ($data as $d)
        {
            $pemb = new Pembayaran($this->conn);
            $pemb->getDataByID($d["id"]);
            if ($pemb->tiket_id)
            {
                $tiket = new TiketWisata($this->conn);
                $tiket->getDataByID($pemb->tiket_id);
                if ($tiket->user_id == $user_id)
                {
                    array_push($r,$pemb);
                    continue;
                }
            }
            $pp = new PesanPenginapan($this->conn);
            $pp->getDataByID($pemb->book_id);
            if ($pp->user_id == $user_id)
            {
                array_push($r,$pemb);
                continue;
            }
        }

        return $r;
    }
}

class PesanPenginapan extends QueryPrepare
{
    public $id, $user_id, $kamar_id, $durasi, $total_harga;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->kamar_id = $data["kamar_id"];
        $this->durasi = $data["durasi"];
        $this->total_harga = $data["total_harga"];
    }

    function getDataByID($id)
    {
        $q = $this->prepare(
            "SELECT * FROM bookhotel WHERE id = ?",
            "i",
            $id
        );
        $q->execute();
        $res = $q->get_result();
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function add()
    {
        $q = $this->prepare(
            "INSERT INTO bookhotel (user_id,kamar_id,total_harga,durasi) VALUES (?,?,?,?)",
            "iiii",
            $this->user_id,
            $this->kamar_id,
            $this->total_harga,
            $this->durasi,
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE bookhotel SET user_id = ?, kamar_id = ?, total_harga = ?, durasi = ? WHERE id = ?",
            "iiiii",
            $this->user_id,
            $this->kamar_id,
            $this->total_harga,
            $this->durasi,
            $this->id
        );
        $q->execute();
    }

    function delete()
    {
        $q = $this->prepare(
            "DELETE FROM bookhotel WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll()
    {
        $data = $this->conn->query("SELECT * FROM bookhotel");
        $r = [];
        foreach ($data as $d)
        {
            $dd = new TiketWisata($this->conn);
            $dd->id = $d["id"];
            $dd->user_id = $d["user_id"];
            $dd->kamar_id = $d["kamar_id"];
            $dd->total_harga = $d["total_harga"];
            $dd->durasi = $d["durasi"];
            array_push($r,$dd);
        }
        return $r;
    }
}