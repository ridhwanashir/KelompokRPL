from selenium import webdriver
from selenium.webdriver import ActionChains

browser = webdriver.Chrome()
browser.get('http://localhost:8080/walkwalk/')

element = browser.find_element_by_xpath('/html/body/nav/div/div/form/a[1]')
ActionChains(browser).click(element).perform()

elem = browser.find_element_by_name('email')  
elem.send_keys('ridhwanashir@student.telkomuniversity.ac.id')

elem = browser.find_element_by_name('password')  
elem.send_keys('123' + Keys.RETURN)