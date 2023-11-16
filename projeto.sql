CREATE TABLE USUARIO  
(
 id INTEGER PRIMARY KEY AUTO_INCREMENT,
 ds_email VARCHAR(50) NOT NULL,   
 nm_usuario VARCHAR(50) NOT NULL,   
 ds_senha VARCHAR(255) NOT NULL,
 cd_usuario CHAR(8) NOT NULL,
 sg_tipo CHAR(5) DEFAULT 'USER'
);

CREATE TABLE EVENTO  
(  
 id_evento INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,   
 nm_evento VARCHAR(50) NOT NULL,   
 ds_evento VARCHAR(100) NOT NULL,   
 dt_evento DATE NOT NULL, 
 id_unidade INTEGER,
 id_usuario INTEGER
);

CREATE TABLE MODALIDADE  
(  
 id_modalidade INTEGER PRIMARY KEY AUTO_INCREMENT,   
 nm_modalidade VARCHAR(50) NOT NULL,   
 ds_modalidade VARCHAR(100) NOT NULL,
 id_usuario INTEGER  
);

CREATE TABLE NOTICIA  
(  
 id_noticia INTEGER PRIMARY KEY AUTO_INCREMENT,
 nm_titulo VARCHAR(250) NOT NULL,   
 ds_conteudo LONGTEXT NOT NULL,
 im_capa_url LONGTEXT,   
 dt_noticia DATE NOT NULL,
 id_usuario INTEGER 
);

CREATE TABLE UNIDADE  
( 
 id_unidade INTEGER PRIMARY KEY AUTO_INCREMENT,    
 nm_unidade VARCHAR(50) NOT NULL,   
 ds_endereco VARCHAR(100) NOT NULL,   
 ds_unidade VARCHAR(100) NOT NULL,   
 id_usuario INTEGER 
);

CREATE TABLE EVENTO_MODALIDADE  
(  
 id_evento INTEGER,   
 id_modalidade INTEGER,   
 qt_modalidade INTEGER NOT NULL 
);

CREATE TABLE NOTICIA_MODALIDADE  
(  
 id_modalidade INTEGER,   
 id_noticia INTEGER,   
 qt_modalidade INTEGER NOT NULL 
);

CREATE TABLE UNIDADE_MODALIDADE  
(  
 id_unidade INTEGER,   
 id_modalidade INTEGER,   
 qt_modalidade INTEGER NOT NULL 
);

ALTER TABLE EVENTO ADD CONSTRAINT evento_unidade_fk FOREIGN KEY(id_unidade) REFERENCES UNIDADE (id_unidade);

ALTER TABLE EVENTO_MODALIDADE ADD CONSTRAINT evento_modalidade_fk FOREIGN KEY(id_evento) REFERENCES EVENTO (id_evento);

ALTER TABLE EVENTO_MODALIDADE ADD CONSTRAINT modalidade_evento_fk FOREIGN KEY(id_modalidade) REFERENCES MODALIDADE (id_modalidade);

ALTER TABLE EVENTO_MODALIDADE ADD CONSTRAINT evento_modalidade_pk PRIMARY KEY(id_modalidade, id_evento);

ALTER TABLE NOTICIA_MODALIDADE ADD CONSTRAINT modalidade_noticia_fk FOREIGN KEY(id_modalidade) REFERENCES MODALIDADE (id_modalidade);

ALTER TABLE NOTICIA_MODALIDADE ADD CONSTRAINT noticia_modalidade_fk FOREIGN KEY(id_noticia) REFERENCES NOTICIA (id_noticia);

ALTER TABLE NOTICIA_MODALIDADE ADD CONSTRAINT noticia_modalidade_pk PRIMARY KEY(id_modalidade, id_noticia);

ALTER TABLE UNIDADE_MODALIDADE ADD CONSTRAINT unidade_modalidade_fk FOREIGN KEY(id_unidade) REFERENCES UNIDADE (id_unidade);

ALTER TABLE UNIDADE_MODALIDADE ADD CONSTRAINT modalidade_unidade_fk FOREIGN KEY(id_modalidade) REFERENCES MODALIDADE (id_modalidade);

ALTER TABLE UNIDADE_MODALIDADE ADD CONSTRAINT unidade_modalidade_pk PRIMARY KEY(id_modalidade, id_unidade);

INSERT INTO usuario(ds_email, nm_usuario, ds_senha, cd_usuario, sg_tipo) VALUES ('admin@admin.com','Admin','123','SP','ADMIN');

