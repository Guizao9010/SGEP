CREATE TABLE USUARIO  
(  
 ds_email VARCHAR(50) PRIMARY KEY,   
 nm_usuario VARCHAR(50) NOT NULL,   
 ds_senha VARCHAR(50) NOT NULL,
 cd_usuario CHAR(8) NOT NULL,
 sg_tipo CHAR(5) DEFAULT('User')
);

CREATE TABLE EVENTO  
(  
 id_evento INTEGER PRIMARY KEY NOT NULL,   
 nm_evento VARCHAR(50),   
 ds_evento VARCHAR(100) NOT NULL,   
 dt_evento DATE NOT NULL, 
 id_unidade INTEGER 
);

CREATE TABLE MODALIDADE  
(  
 id_modalidade INTEGER PRIMARY KEY,   
 nm_modalidade VARCHAR(50) NOT NULL,   
 ds_modalidade VARCHAR(100) NOT NULL  
);

CREATE TABLE NOTICIA  
(  
 id_noticia INTEGER PRIMARY KEY,   
 ds_conteudo VARCHAR(100) NOT NULL,   
 dt_noticia DATE NOT NULL 
);

CREATE TABLE UNIDADE  
(  
 nm_unidade VARCHAR(50) NOT NULL,   
 ds_endereco VARCHAR(100) NOT NULL,   
 ds_unidadade VARCHAR(100) NOT NULL,   
 id_unidade INTEGER PRIMARY KEY 
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

