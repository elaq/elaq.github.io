CREATE TABLE Student (
  Nr_indeksu CHAR(6),
  Nazwisko VARCHAR(45),
  Imie VARCHAR(20),
  Haslo VARCHAR(10) NOT NULL,
  Liczba_zetonow INTEGER,
  PRIMARY KEY (Nr_indeksu)
);

CREATE TABLE Przedmioty (
  Kod CHAR(4),
  Nazwa VARCHAR(45),
  Limit_miejsc INTEGER,
  Termin_zapisu DATE,
  PRIMARY KEY (Kod)
);

CREATE TABLE Administrator (
  ID CHAR(6),
  Nazwisko VARCHAR(45),
  Imie VARCHAR(20),
  Haslo VARCHAR(10) NOT NULL,
  PRIMARY KEY(ID)
);

CREATE TABLE Wymagania (
  Przedmioty_Kod CHAR(4),
  Wymagany_Kod CHAR(4),
  FOREIGN KEY(Przedmioty_Kod) REFERENCES Przedmioty(Kod),
  FOREIGN KEY(Wymagany_Kod) REFERENCES Przedmioty(Kod),
  PRIMARY KEY(Przedmioty_Kod, Wymagany_Kod)
);

CREATE TABLE Rejestracje_Zaliczenia (
  Przedmioty_Kod CHAR(4) NOT NULL,
  Student_Nr_indeksu CHAR(6) NOT NULL,
  Status_przedmiotu CHAR(1) CHECK (Status_przedmiotu in ('p','r','o','z')) NOT NULL,
  FOREIGN KEY(Student_Nr_indeksu) REFERENCES Student(Nr_indeksu),
  FOREIGN KEY(Przedmioty_Kod) REFERENCES Przedmioty(Kod),
  PRIMARY KEY(Przedmioty_Kod, Student_Nr_indeksu)
);


INSERT INTO Student VALUES ('266745', 'Kukla', 'El¿bieta', 'kukelz', '8');
INSERT INTO Student VALUES ('262654', 'Nowak', 'Marek', 'nowmar', '3');
INSERT INTO Student VALUES ('261652', 'Zieliñski', 'Andrzej', 'zieand', '1');
INSERT INTO Student VALUES ('267652', 'Krawczyk', 'Agnieszka', 'kraagn', '2');
INSERT INTO Student VALUES ('654321', 'Malinowski', 'Wojciech', 'student', '5');
INSERT INTO Administrator VALUES ('123456', 'Kowalski', 'Jan', 'admin');

INSERT INTO Przedmioty VALUES ('BD00','Bazy danych','1','2010-03-25');
INSERT INTO Przedmioty VALUES ('FAN0','Funkcje analityczne','2','2010-06-27');
INSERT INTO Przedmioty VALUES ('AM11','Analiza matematyczna 1.1','9','2010-06-27');
INSERT INTO Przedmioty VALUES ('AM12','Analiza matematyczna 1.2','3','2010-06-27');
INSERT INTO Przedmioty VALUES ('AM21','Analiza matematyczna 2.1','2','2010-03-25');
INSERT INTO Przedmioty VALUES ('AM22','Analiza matematyczna 2.2','1','2010-09-01');
INSERT INTO Przedmioty VALUES ('WDI1','Wstêp do informatyki 1','5','2010-09-01');
INSERT INTO Przedmioty VALUES ('WDI2','Wstêp do informatyki 2','5','2010-09-01');
INSERT INTO Przedmioty VALUES ('ALG1','Algebra 1','8','2010-06-25');
INSERT INTO Przedmioty VALUES ('ALG2','Algebra 2','8','2010-06-25');
INSERT INTO Przedmioty VALUES ('ALG3','Algebra 3','8','2010-06-25');
INSERT INTO Przedmioty VALUES ('RP10','Rachunek prawdopodobieñstwa 1','8','2010-06-25');
INSERT INTO Przedmioty VALUES ('RP20','Rachunek prawdopodobieñstwa 2','8','2010-03-25');
INSERT INTO Przedmioty VALUES ('RRZ0','Równania ró¿niczkowe zwyczajne','10','2010-06-25');
INSERT INTO Przedmioty VALUES ('RRC1','Równania ró¿niczkowe cz±stkowe 1','8','2010-06-27');
INSERT INTO Przedmioty VALUES ('S100','Statystyka 1','9','2010-06-27');
INSERT INTO Przedmioty VALUES ('S200','Statystyka 2','4','2010-06-27');

INSERT INTO Wymagania VALUES ('FAN0','AM21');
INSERT INTO Wymagania VALUES ('AM12','AM11');
INSERT INTO Wymagania VALUES ('AM21','AM12');
INSERT INTO Wymagania VALUES ('AM22','AM21');
INSERT INTO Wymagania VALUES ('WDI2','WDI1');
INSERT INTO Wymagania VALUES ('RP20','RP10');
INSERT INTO Wymagania VALUES ('RRC1','RRZ0');
INSERT INTO Wymagania VALUES ('RRC1','AM22');
INSERT INTO Wymagania VALUES ('S200','S100');
INSERT INTO Wymagania VALUES ('ALG2','ALG1');
INSERT INTO Wymagania VALUES ('ALG3','ALG2');
