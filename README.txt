Instrukcije i problemi na koje sam naisao tokom zadatka;

1. Za ubacivanje passworda u bazu, pokusao sam da hashujem password prvo,
   ali sam naisao na problem kasnije pri uporednjivanju passworda za login sekciju,
   tako da sam se odlucio bez hashovanja, iako znam da nije bezbedno.

2. Bazu sam rucno napravio preko phpMyAdmin, iako je moguce i kroz kod napraviti bazu ukoliko ne postoji.

3. Trudio sam se da zavrsim sto vise u zadatih 5 sati, a komentarisanje koda sam ostavo za kraj.

4. Home link sam namerno stavio da brise $_SESSION za login, da bi lako mogao proveriti da li 
   search radi kao treba kad je user ulogovan i kada nije.

5. Posto sam dosta uradio i tek onda se setio da moram commit-ovati proces, uradio sam samo dva commit-a, nazalost.

6. Moj proces je bio sledeci.
        a. Napraviti index, header i footer bez stilizovanje za pocetak
        b. Napraviti css file prazan za pocetak i linkovati ga.
        c. Napraviti register.php, login.php, i results.php
        d. Napraviti praznu bazu preko phpMyAdmin sa user u njoj (id-primary autoinrement, name, email, password);
        e. Preko register.php proveriti inpute i povezati se na bazu koristeci PDO, jer je sigurniji
        f. Proveriti da li user postoji u bazi, registrovati ga ako ne, i smestiti email u $_SESSION.
        g. Napraviti login.php, proveriti da li korisnika vec ima u $_SESSION, ako ne onda pokusati login
        h. Napraviti query u result.php ukoliko je korisnik ulogovan i proveriti da li postoji u bazi
        i. Poslednjih 10 minuta na stilizaciju
