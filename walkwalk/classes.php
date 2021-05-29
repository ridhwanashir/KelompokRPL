<?php
// classes.php berisi kelas-kelas
class QueryPrepare // membangun koneksi database dan sql untuk menjalankan query
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

class Admin extends QueryPrepare // kelas admin
{
    public $id,$username,$password;

    function syncAssoc($data) // sinkronisasi data 
    {
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->password = $data["password"];
    }
    
    function getDataByID($id) // mengambil data dari database berdasarkan id
    {
        $q = $this->prepare(
            "SELECT * FROM admin WHERE id = ?",
            "i",
            $id
        );
        $q->execute(); // execute query
        $res = $q->get_result(); // menyimpan hasil query
        $data = $res->fetch_assoc();
        $this->syncAssoc($data);
        return $data;
    }

    function loginAdmin() // fungsi login admin
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

    function editUser() // fungsi edit data pribadi user
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

    function registerUser() // fungsi register user
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

    function loginWithEmail() // fungsi login user
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

    function add() // menambahkan tempatwisata
    {
        $q = $this->prepare(
            "INSERT INTO tempat_wisata (nama_tempat,alamat,harga) VALUES (?,?,?)",
            "ssi",
            $this->nama_tempat,
            $this->alamat,
            $this->harga
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit() // edit tempatwisata
    {
        $q = $this->prepare(
            "UPDATE tempat_wisata SET nama_tempat = ?, alamat = ?, harga = ? WHERE id = ?",
            "ssii",
            $this->nama_tempat,$this->alamat,$this->harga,$this->id
        );
        $q->execute();
    }

    function delete() // delete tempatwisata
    {
        $q = $this->prepare(
            "DELETE FROM tempat_wisata WHERE id = ?",
            "i",
            $this->id
        );
        $q->execute();
    }

    function getAll() // mengambil data tempatwisata
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
            array_push($r,$dd);
        }
        return $r;
    }

    function searchAlamat($alamat) // mencari alamat tempatwisata
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

    function searchNamaTempat($nama_tempat) // mencari nama tempatwisata
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
            "INSERT INTO penginapan (nama_tempat,alamat) VALUES (?,?)",
            "ss",
            $this->nama_tempat,
            $this->alamat
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($q->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE penginapan SET nama_tempat = ?, alamat = ? WHERE id = ?",
            "ssi",
            $this->nama_tempat,$this->alamat,$this->id
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
    public $id,$nama,$no_rek;

    function syncAssoc($data)
    {
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->no_rek = $data["no_rek"];
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
            "INSERT INTO metode_pembayaran (nama,no_rek) VALUES (?,?)",
            "ss",
            $this->nama,
            $this->no_rek
        );
        $q->execute();
        $res = $q->get_result();
        $this->getDataByID($res->insert_id);
        return $q;
    }

    function edit()
    {
        $q = $this->prepare(
            "UPDATE metode_pembayaran SET nama = ?, no_rek = ? WHERE id = ?",
            "ssi",
            $this->nama,
            $this->no_rek,
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
            $dd->no_rek = $d["no_rek"];
            array_push($r,$dd);
        }
        return $r;
    }
}