CREATE TABLE Action(
   Id_Action INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   code VARCHAR(50),
   label VARCHAR(50),
   last VARCHAR(50),
   dateHours VARCHAR(50),
   aClose VARCHAR(50),
   aOpen VARCHAR(50),
   currency VARCHAR(50),
   high VARCHAR(50),
   low VARCHAR(50),
   totalVolume VARCHAR(50),
   ticket VARCHAR(50),
   endOfTheDay VARCHAR(50)
);

CREATE TABLE Forum(
   Id_Forum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
   codeAction VARCHAR(50),
   auteur VARCHAR(50),
   dateForum VARCHAR(50),
   hoursForum VARCHAR(50),
   content VARCHAR(50)
);