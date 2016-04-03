CREATE DATABASE IF NOT EXISTS Palestra;
CREATE TABLE IF NOT EXISTS Palestra.utenti(
username character(20) unique NOT NULL,
password character(20) NOT NULL,
codicefiscale character(20) primary key) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Maestri(
Nome character(20) NOT NULL,
Cognome character(20) NOT NULL,
DataNascita date NOT NULL,
NumTel character(15),
codfiscale character (16) primary key,
FOREIGN KEY (codfiscale) REFERENCES palestra.utenti(codicefiscale) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Discipline(
Nome character(20) PRIMARY KEY) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Insegnamento(
Insegnante character(16) NOT NULL,
Disciplina character(20) NOT NULL,
PRIMARY KEY (Insegnante,Disciplina),
FOREIGN KEY (Insegnante)
REFERENCES Palestra.Maestri(codfiscale) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (Disciplina)
REFERENCES Palestra.Discipline(Nome) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Allievo(
CodiceFiscale character(16) PRIMARY KEY,
Nome character(20) NOT NULL,
Cognome character(20) NOT NULL,
DataNascita date NOT NULL,
Pagamenti_in_regola BOOLEAN NOT NULL,
FOREIGN KEY (codicefiscale) REFERENCES palestra.utenti(codicefiscale) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Agonisti(
Disciplina character(20) not null,
Allievo character(16) not null,
primary key(Disciplina,Allievo),
foreign key (Disciplina) references Palestra.Discipline(Nome) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (Allievo) references Palestra.Allievo(CodiceFiscale) ON DELETE CASCADE ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Non_Agonisti(
Disciplina character(20) not null,
Allievo character(16) not null,
Amatore BOOLEAN NOT NULL,
primary key(Disciplina,Allievo),
foreign key (Disciplina) references Palestra.Discipline(Nome) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (Allievo) references Palestra.Allievo(CodiceFiscale) ON DELETE CASCADE ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Corsi(
Insegnante character(16),
Disciplina character(20) NOT NULL,
Prezzo INTEGER,
id_corso integer AUTO_INCREMENT primary key,
fascia_eta character(20) NOT NULL,
agonistico BOOLEAN NOT NULL,
FOREIGN KEY (Insegnante) references Palestra.Maestri(codfiscale) ON UPDATE CASCADE ON DELETE SET NULL,
FOREIGN KEY (Disciplina) references Palestra.Discipline(Nome) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Iscrizione(
Allievo character (16) NOT NULL,
Corso integer NOT NULL,
PRIMARY KEY (Allievo,Corso),
FOREIGN KEY (Allievo) references Palestra.Allievo(CodiceFiscale) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (Corso) references Palestra.Corsi(id_corso) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Gare(
Ubicazione character(100) NOT NULL,
Giorno datetime NOT NULL,
Disciplina character(20) NOT NULL,
Costo_trasferta int,
NomeGara character(40) NOT NULL,
PRIMARY KEY (Ubicazione,Giorno,Disciplina),
FOREIGN KEY (Disciplina) references Palestra.Discipline(Nome) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Preiscrizioni(
Allievo character(16) not null,
UbicazioneGara character(100) not null,
GiornoGara datetime not null,
Disciplina character(20) not null,
primary key (Allievo,UbicazioneGara,GiornoGara,Disciplina),
foreign key (Allievo) references Palestra.agonisti(Allievo) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key(UbicazioneGara,GiornoGara,Disciplina) references Palestra.Gare(Ubicazione,Giorno,Disciplina) ON DELETE CASCADE ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Palestre(
Ubicazione character(100) primary key,
affitto integer) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS Palestra.Lezione(
inizio datetime not null,
fine datetime not null,
palestra character(100) not null,
corso integer not null,
primary key (inizio,fine,palestra,corso),
foreign key (palestra) references Palestra.Palestre(Ubicazione) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key (corso) references Palestra.corsi(id_corso) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;