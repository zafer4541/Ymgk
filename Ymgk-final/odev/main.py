import base64
import random

from Cryptodome.Cipher import AES
from Cryptodome.Hash import SHA256

hashObject = SHA256.new() #sha şifrelemesi için yeni bir nesne üretiyorum
f=open('myfile.doc','w')
mersenneTwis=""
for i in range(1000000):
    a = str(random.randint(0, 1)) + '/'  # pythonun random kütüphanesi mersenne twister ile sayı üretiyormuş
    mersenneTwis = mersenneTwis + str(a) # bundan dolayı 1 milyon tane random fonksiyonu ile sayı ürettim ürettiğim sayıları bir doc dosyasına kaydettim ki nestten geçirebileyim

f.write(mersenneTwis[:len(mersenneTwis)-1]) # doc dosyasına yazdım
msg_text = bytes(mersenneTwis.replace('/',''),'utf-8')# mersenne twister ile ürettiğim 1 milyon bitin içinden ayırma operatörü için kullandığım operatörü kaldırdım string halinde toplamıştım şimdi bunları bite çevirdim
secret_key = b'1234567890123456' #aes şifreleme için gerekli olan şifreleme anahtarı
cipher = AES.new(secret_key,AES.MODE_ECB) #şifreleme anahtarı ile block şifreleme yapıcağımı ve bunun belirtiyorum bana ilgili nesneyi üretiyor
encoded = base64.b64encode(cipher.encrypt(msg_text))#ürettiği aes nesnesi ile şifreleme işlemini yapıyorum
print(encoded) #aes ile şifrelenen 1 milyon biti yazdırıyorum
print('yeni 1 milyon bitin şifreli hali')
hashObject.update(encoded) #aes uygulaması ile şifrelediğim 1 milyon biti şimdide sha 256 ile şifreliyorum böylelikle katmanlı bir şifreleme işlemine sokmuş oluyorum
print(hashObject.hexdigest()) #sha algoritmasi ile şifrelediğimde verdiği metni yazdıyorum

