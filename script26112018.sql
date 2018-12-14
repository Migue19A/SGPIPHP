INSERT INTO "gestionDocAlum" ("actividades_actuales", "folio_proyecto", "id_doc_alum", "id_tipo_cambio", "semestre", "servic", "resid", "tesis") VALUES
                            ('Muchas cosas', 
                            'PRE4',
                            '117O4525',
                            1,
                            7,
                            '0',
                            '0',
                             '1');
delete from "gestionDocAlum" where "actividades_actuales" is null

INSERT INTO "gestionDocAlum" ("actividades_actuales", "folio_proyecto", "id_alum", "id_tipo_cambio", "semestre", "servic", "resid", "tesis", "nc_reemplazo") VALUES
                            ('DISEÑAR LA BASE DE DATOS', 
                            'PRE4',
                            '127O0949',
                            5,
                            7,
                            '0',
                            '0',
                            '0',
                             '127O1254');
							 
select * from "gestionDocAlum"	}


UPDATE "alumno" SET "estado" = 1 WHERE "NoControl" = '127O0949';



CREATE TABLE public."cambioAlumnos" (
	id_solicitud SERIAL PRIMARY KEY NOT NULL,
    id_alum character varying(20) NOT NULL,
    folio_proyecto character varying(50) NOT NULL,
    id_tipo_cambio integer NOT NULL,
    motivo character varying(200),
    nc_reemplazo character varying(20),
    fecha_peticion date DEFAULT now(),
	semestre integer,
	servic bit NOT NULL DEFAULT '0',
	resid bit NOT NULL DEFAULT '0',
	tesis bit NOT NULL DEFAULT '0',
    actividades_actuales character varying(255)
);

CREATE TABLE public."cambioColaboradores" (
	id_solicitud SERIAL PRIMARY KEY NOT NULL,
    id_doc integer NOT NULL,
    folio_proyecto character varying(20) NOT NULL,
    id_tipo_cambio integer NOT NULL,
    motivo character varying(200),
    np_reemplazo integer,
    fecha_peticion date DEFAULT now(),
    actividades_actuales character varying(255)
);


SELECT "NoPersonal", upper(usu."Nombre") AS Nombre, upper(usu."ApellidoP") AS ApellidoP, upper(usu."ApellidoM") AS 
ApellidoM, usu."estado" AS estado, "idCarrera" academia, usu."CorreoInstitucional", doce."correo_alternativo" 
correo_alt, doce."GradoMaximoEstudios", doce."TelefonoMovil", coldc."Actividades" actividades 
FROM usuario usu INNER JOIN docente doce ON doce."noPersonal" = usu."NoPersonal" 
INNER JOIN carrera ON "Carrera_idCarrera" = "idCarrera" INNER JOIN colaboradordocente coldc 
ON coldc. "Docente_noPersonal" = usu. "NoPersonal" WHERE "estado"= 1 and "noPersonal" =5;



INSERT INTO "cambioAlumnos" ("motivo", "folio_proyecto", "id_alum", "id_tipo_cambio") VALUES ('Porque ya no me parece su trabajo',  'PRE4', '127O0949', 8);

SELECT alum."NoControl" control_alum, upper(alum."Paterno") pat_alum, upper(alum."Materno") mat_alum, 
upper(alum."Nombre") nombre_alum, alum."estado" sdo_alum, "idCarrera" academia, alD."servicio" serv, alD."residencia" resid, alD."tesis" tes, "semestre" sems, "actividades" activs FROM alumno alum INNER JOIN alumnoscolaboradoresdetalle alD ON alum."NoControl" = alD."FkNoControl" 
INNER JOIN carrera aca ON alum."id_carrera"= aca."idCarrera" WHERE alum."NoControl" = '117O4525';

SELECT * FROM proyecto


select * from "cambioAlumnos"


select cambio."id_solicitud" solicitud, proy."NombreProyecto" nom_proy, 
proy."Responsable" responsable, cambio."fecha_peticion" fecha_solic, tipos_solic."descripcion"
FROM "cambioColaboradores" cambio INNER JOIN proyecto proy ON cambio."folio_proyecto"= proy."FolioProyecto"
INNER JOIN "cat_tipos_solicitudes" tipos_solic ON cambio."id_tipo_cambio" = tipos_solic."id" 

SELECT cambio."id_solicitud" solicitud, proy."NombreProyecto" nom_proy, proy."Responsable" responsable, 
cambio."fecha_peticion" fecha_solic, tipos_solic."descripcion" tipoS 
FROM "cambioColaboradores" cambio INNER JOIN "proyecto" proy 
ON cambio."folio_proyecto"= proy."FolioProyecto" INNER JOIN "cat_tipos_solicitudes" tipos_solic 
ON cambio."id_tipo_cambio" = tipos_solic."id";

select * from "cambioColaboradores"


SELECT cambio."id_solicitud" solicitud, proy."NombreProyecto" nom_proy, proy."Responsable" responsable, 
cambio."fecha_peticion" fecha_solic, tipos_solic."descripcion" tiposoli, tipos_solic."id" int_tipo 
FROM "cambioAlumnos" cambio INNER JOIN "proyecto" proy ON cambio."folio_proyecto"= proy."FolioProyecto" 
INNER JOIN "cat_tipos_solicitudes" tipos_solic ON cambio."id_tipo_cambio" = tipos_solic."id";



SELECT cambio."id_solicitud" solicitud, proy."NombreProyecto" nom_proy, 
proy."Responsable" responsable, cambio."fecha_peticion" fecha_solic, tipos_solic."descripcion" tiposoli, 
tipos_solic."id" int_tipo, cambio."id_alum" nc_alum, cambio."folio_proyecto" folio_p, cambio."motivo" 
motivo, cambio."nc_reemplazo" nc_reem, cambio."semestre" sem_alum, cambio."servic" servicio, cambio."resid" residencia, 
cambio."tesis" tesis, cambio."actividades_actuales" activ_alum FROM "cambioAlumnos" cambio 
INNER JOIN "proyecto" proy ON cambio."folio_proyecto"= proy."FolioProyecto" 
INNER JOIN "cat_tipos_solicitudes" tipos_solic ON cambio."id_tipo_cambio" = tipos_solic."id";


SELECT alum."NoControl" control_alum, alum."Paterno" pat_alum, alum."Materno" mat_alum, alum."Nombre" 
nombre_alum, alumD."actividades" activ_alum, alum."estado" sdo_alum, entre."Etapas_noEtapa" 
etapa_actual FROM alumnoscolaboradoresdetalle alumD INNER JOIN proyecto proy ON proy."FolioProyecto" = alumD."folioproyecto"
INNER JOIN "alumno" alum ON alum."NoControl" = alumD."FkNoControl" 
INNER JOIN entregable entre ON alum."Folio_proyecto" = entre."Etapas_FolioProyecto" 
WHERE proy."FolioProyecto"= 'PRE4' and entre."Estatus" = 1 ;


INSERT INTO "observaciones" ("ObservacionesInvestigacion", "CatObservaciones_idObservaciones", 
"Proyecto_FolioProyecto") VALUES('No sirve', 11, 'PR	E4');
SELECT * FROM "observaciones"
DELETE FROM "observaciones" WHERE "ObservacionesInvestigacion" = 'Como veas tú';
DELETE FROM "observaciones" WHERE "ObservacionesGestion" = '¿Cómo ves Kori?';
