DELIMITER $$
DROP FUNCTION IF EXISTS contalezioni;
$$
CREATE FUNCTION contalezioni (idcorso int(11)) 
RETURNs integer
BEGIN 
DECLARE numlezioni integer; 
SELECT COUNT(*) INTO numlezioni FROM palestra.lezione WHERE corso=idcorso;
RETURN numlezioni; 
END $$
DROP FUNCTION IF EXISTS guadagnocorso;
$$
CREATE FUNCTION guadagnocorso(idcorso int(11)) 
RETURNS integer
BEGIN  
DECLARE prezzocorso integer; 
DECLARE numiscritti integer;
SELECT COUNT(*) INTO numiscritti FROM palestra.iscrizione WHERE corso=idcorso;
SELECT prezzo INTO prezzocorso FROM palestra.corsi WHERE id_corso=idcorso;
RETURN prezzocorso*numiscritti;
END $$
DROP FUNCTION IF EXISTS fasciaanni;
 $$
CREATE FUNCTION fasciaanni (cf CHARACTER(20)) 
RETURNs CHARACTER(20)
BEGIN 
DECLARE anni integer;
DECLARE nascita date;
select DataNascita into nascita from palestra.allievo where codicefiscale=cf;
select  TIMESTAMPDIFF(YEAR,(nascita),CURDATE( )) into anni;
    CASE
      WHEN (anni>=0 and anni<=11) THEN RETURN('-11');
      WHEN (anni>11 and anni<=15) THEN return('12-15');
      WHEN (anni>15 and anni<=35) THEN return('16-35');
      WHEN (anni>35 and anni<150) THEN return('+35');
    END CASE;
END
$$
DROP Trigger IF EXISTS checkfascia;
 $$
CREATE TRIGGER checkfascia BEFORE INSERT ON palestra.iscrizione
FOR EACH ROW BEGIN
declare cfallievo CHARACTER(20);
DECLARE fasciallievo CHARACTER(20);
DECLARE fasciacorso CHARACTER(20);
select codicefiscale into cfallievo from palestra.allievo WHERE codicefiscale=new.allievo;
select fasciaanni(cfallievo) into fasciallievo;
SELECT fascia_eta into fasciacorso from palestra.corsi where id_corso=new.corso;
if fasciallievo!=fasciacorso
THEN
set new.allievo=NULL;
END IF;
END 
$$
DROP TRIGGER IF EXISTS controllaorario;
 $$
CREATE TRIGGER controllaorario BEFORE INSERT ON palestra.lezione
FOR EACH ROW
BEGIN
IF NEW.inizio>NEW.fine 
THEN SET NEW.inizio=NULL;
END IF;
END 
$$