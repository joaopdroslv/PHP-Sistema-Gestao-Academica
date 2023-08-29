DROP SCHEMA IF EXISTS `faculdade` ;
CREATE SCHEMA IF NOT EXISTS `faculdade` DEFAULT CHARACTER SET utf8 ;
USE `faculdade` ;

DROP TABLE IF EXISTS `faculdade`.`usuario` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`usuario` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codigo`));


DROP TABLE IF EXISTS `faculdade`.`turma` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`turma` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `curso` VARCHAR(45) NOT NULL,
  `semestre` INT(11) NOT NULL,
  `periodo` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`codigo`));

DROP TABLE IF EXISTS `faculdade`.`aluno` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`aluno` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `turma_codigo` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`, `turma_codigo`),
  CONSTRAINT `fk_aluno_turma`
    FOREIGN KEY (`turma_codigo`)
    REFERENCES `faculdade`.`turma` (`codigo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

DROP TABLE IF EXISTS `faculdade`.`professor` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`professor` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `data_nasc` DATE NOT NULL,
  PRIMARY KEY (`codigo`));

DROP TABLE IF EXISTS `faculdade`.`disciplina` ;
CREATE TABLE IF NOT EXISTS `faculdade`.`disciplina` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(255) NULL DEFAULT NULL,
  `professor_codigo` INT(11) NOT NULL,
  `turma_codigo` INT(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  CONSTRAINT `fk_disciplina_professor`
    FOREIGN KEY (`professor_codigo`)
    REFERENCES `faculdade`.`professor` (`codigo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_disciplina_turma`
    FOREIGN KEY (`turma_codigo`)
    REFERENCES `faculdade`.`turma` (`codigo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

INSERT INTO `faculdade`.`usuario`(username, senha) VALUES ("administrador", "123456");

INSERT INTO `faculdade`.`turma`(curso, semestre, periodo) VALUES ("Administração", 2, "Noturno");
INSERT INTO `faculdade`.`turma`(curso, semestre, periodo) VALUES ("Analise e desenvolvimento de sistemas", 4, "Noturno");
INSERT INTO `faculdade`.`turma`(curso, semestre, periodo) VALUES ("Engenharia", 1, "Diurno");

INSERT INTO `faculdade`.`aluno`(nome, cpf, data_nasc, turma_codigo) VALUES ("Gabriela", "99988877799", "2003-09-29", 2);
INSERT INTO `faculdade`.`aluno`(nome, cpf, data_nasc, turma_codigo) VALUES ("Martarelli", "9999999999", "1990-07-11", 3);

INSERT INTO `faculdade`.`professor`(nome, cpf, data_nasc) VALUES ("João", "99988877799", "2002-05-27");
INSERT INTO `faculdade`.`professor`(nome, cpf, data_nasc) VALUES ("Ana", "9999999999", "1996-03-13");

INSERT INTO `faculdade`.`disciplina`(nome, descricao, professor_codigo, turma_codigo) VALUES ("Linguagem de Programação IV", "Linguagem de programação web utilizando php", 1, 2 );

INSERT INTO `faculdade`.`disciplina`(nome, descricao, professor_codigo, turma_codigo) VALUES ("Programação Orientada a Objetos", "Programação Orientada a Objetos", 2, 1);