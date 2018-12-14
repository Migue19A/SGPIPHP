--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.3
-- Dumped by pg_dump version 9.6.3

-- Started on 2018-09-08 22:03:01

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2448 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 185 (class 1259 OID 25924)
-- Name: actividadesproyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE actividadesproyecto (
    "No.Actividad" integer NOT NULL,
    "DescripcionActividades" character varying(45) NOT NULL,
    "Alcance" character varying(45) NOT NULL,
    "Observaciones" character varying(500) NOT NULL,
    "InformeGeneral_IdInformeGeneral" integer NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE actividadesproyecto OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 25930)
-- Name: alumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE alumno (
    "NoControl" character varying(9) NOT NULL,
    "Semestre" character varying(45) NOT NULL,
    "Nombre" character varying(45) NOT NULL,
    "Paterno" character varying(45) NOT NULL,
    "Materno" character varying(45) NOT NULL,
    id_carrera integer NOT NULL,
    "Actividades" character varying(256),
    "Folio_proyecto" character varying(10),
    servicio boolean,
    residencia boolean,
    tesis boolean
);


ALTER TABLE alumno OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 26193)
-- Name: alumnoscolaboradoresdetalle; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE alumnoscolaboradoresdetalle (
    pkdetalle_alumnocoldetalle integer NOT NULL,
    folioproyecto character varying(7),
    "FkNoControl" character varying(9)
);


ALTER TABLE alumnoscolaboradoresdetalle OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 25933)
-- Name: asesor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE asesor (
    "IdUsuario" integer NOT NULL,
    "GradoMaximoEstudios" character varying(45),
    "TelefonoMovil" integer,
    "DescripcionPrincipalesActividadesProyecto" character varying(45)
);


ALTER TABLE asesor OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 25936)
-- Name: carrera; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE carrera (
    "idCarrera" integer NOT NULL,
    "Descripcion" character varying(60)
);


ALTER TABLE carrera OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 25939)
-- Name: carrera_idCarrera_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "carrera_idCarrera_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "carrera_idCarrera_seq" OWNER TO postgres;

--
-- TOC entry 2449 (class 0 OID 0)
-- Dependencies: 189
-- Name: carrera_idCarrera_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "carrera_idCarrera_seq" OWNED BY carrera."idCarrera";


--
-- TOC entry 190 (class 1259 OID 25941)
-- Name: catmetasalumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE catmetasalumno (
    "idMetas" integer NOT NULL,
    "Descripcion" character varying(10)
);


ALTER TABLE catmetasalumno OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 25944)
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "catmetasalumno_idMetas_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "catmetasalumno_idMetas_seq" OWNER TO postgres;

--
-- TOC entry 2450 (class 0 OID 0)
-- Dependencies: 191
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "catmetasalumno_idMetas_seq" OWNED BY catmetasalumno."idMetas";


--
-- TOC entry 192 (class 1259 OID 25946)
-- Name: catobservcaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE catobservcaciones (
    "idObservaciones" integer NOT NULL,
    "Descripcion" character varying(45) NOT NULL
);


ALTER TABLE catobservcaciones OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 25949)
-- Name: catsancion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE catsancion (
    "idCatSancion" integer NOT NULL,
    "Descripcion" character varying(45)
);


ALTER TABLE catsancion OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 25952)
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "catsancion_idCatSancion_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "catsancion_idCatSancion_seq" OWNER TO postgres;

--
-- TOC entry 2451 (class 0 OID 0)
-- Dependencies: 194
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "catsancion_idCatSancion_seq" OWNED BY catsancion."idCatSancion";


--
-- TOC entry 195 (class 1259 OID 25954)
-- Name: colaboradordocente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE colaboradordocente (
    "Actividades" character varying(512),
    "Proyecto_FolioProyecto" character varying(7),
    "Docente_noPersonal" integer NOT NULL,
    ap_paterno character varying(15),
    ap_materno character varying,
    grado_max_estudios character varying(15),
    celular bigint NOT NULL,
    correo_institucional character varying(50),
    correo_alternativo character varying(100) NOT NULL,
    id_carrera integer,
    nombre character varying(30)
);


ALTER TABLE colaboradordocente OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 25960)
-- Name: constancias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE constancias (
    "FolioConstancias" character varying(10) NOT NULL,
    "Fecha" date NOT NULL,
    "Mensaje" character varying(45) NOT NULL,
    "TipoConstancia" character varying(45) NOT NULL,
    "Etapas_FolioProyecto" character varying(7) NOT NULL,
    "Etapas_noEtapa" integer NOT NULL
);


ALTER TABLE constancias OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 25963)
-- Name: docente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE docente (
    "noPersonal" integer NOT NULL,
    "GradoMaximoEstudios" character varying(45) NOT NULL,
    "TelefonoMovil" integer NOT NULL,
    "Carrera_idCarrera" integer NOT NULL
);


ALTER TABLE docente OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 25966)
-- Name: entregable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE entregable (
    "idEntregable" integer NOT NULL,
    "FechaEntrega" date NOT NULL,
    "Observaciones" character varying(45) NOT NULL,
    "Etapas_FolioProyecto" character varying(7) NOT NULL,
    "Etapas_noEtapa" integer NOT NULL
);


ALTER TABLE entregable OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 25969)
-- Name: entregable_idEntregable_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "entregable_idEntregable_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "entregable_idEntregable_seq" OWNER TO postgres;

--
-- TOC entry 2452 (class 0 OID 0)
-- Dependencies: 199
-- Name: entregable_idEntregable_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "entregable_idEntregable_seq" OWNED BY entregable."idEntregable";


--
-- TOC entry 200 (class 1259 OID 25971)
-- Name: estadoproyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estadoproyecto (
    "idEstado" integer NOT NULL,
    "Descripcion" character varying(45)
);


ALTER TABLE estadoproyecto OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 25974)
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "estadoproyecto_idEstado_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "estadoproyecto_idEstado_seq" OWNER TO postgres;

--
-- TOC entry 2453 (class 0 OID 0)
-- Dependencies: 201
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "estadoproyecto_idEstado_seq" OWNED BY estadoproyecto."idEstado";


--
-- TOC entry 202 (class 1259 OID 25976)
-- Name: etapas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE etapas (
    "FolioProyecto" character varying(7) NOT NULL,
    "noEtapa" integer NOT NULL,
    "NombreEtapa" character varying(45) NOT NULL,
    "FechaInicio" date NOT NULL,
    "FechaFin" date NOT NULL,
    "Meses" integer NOT NULL,
    "Descripcion" character varying(256) NOT NULL,
    "Metas" character varying(256) NOT NULL,
    "Actividades" character varying(256) NOT NULL,
    "Productos" character varying(256) NOT NULL,
    "PkEtapas" integer NOT NULL
);


ALTER TABLE etapas OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 25982)
-- Name: financiamientorequerido; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE financiamientorequerido (
    "FolioProyecto" character varying(7) NOT NULL,
    "Financiamiento" boolean NOT NULL,
    "Interno" boolean,
    "Externo" boolean,
    "Especificar" character varying(45),
    "Infraestructura" numeric(7,2),
    "Consumibles" numeric(7,2),
    "Licencias" numeric(7,2),
    "Viaticos" numeric(7,2),
    "Publicaciones" numeric(7,2),
    "Equipo" numeric(7,2),
    "Patentes" numeric(7,2),
    "Otros" numeric(7,2),
    "Especifique" character varying(45)
);


ALTER TABLE financiamientorequerido OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 25985)
-- Name: lineainvestigacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE lineainvestigacion (
    id integer NOT NULL,
    descripcion character varying(45)
);


ALTER TABLE lineainvestigacion OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 25988)
-- Name: logrosconocimiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE logrosconocimiento (
    "AvancesConocimientoCientifico" integer NOT NULL,
    "DesarrolloTecnologico" character varying(45) NOT NULL,
    "InfraestructuraTecnologica" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE logrosconocimiento OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 25991)
-- Name: logrosdivulgacionpublicaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE logrosdivulgacionpublicaciones (
    "TituloDelArticulo" integer NOT NULL,
    "TipoPublicacion" character varying(45) NOT NULL,
    "NombrePublicacion" character varying(45) NOT NULL,
    "Lugar" character varying(45) NOT NULL,
    "Fecha" date NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE logrosdivulgacionpublicaciones OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 25994)
-- Name: logrospresentacioneseventos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE logrospresentacioneseventos (
    "TituloPonencia" character varying(45) NOT NULL,
    "TipoDePonencia" character varying(45) NOT NULL,
    "NombreEvento" character varying(45) NOT NULL,
    "Lugar" character varying(45) NOT NULL,
    "Fecha" date NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE logrospresentacioneseventos OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 25997)
-- Name: logrosrecursoshumanos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE logrosrecursoshumanos (
    "NombreTrabajo" character varying(45) NOT NULL,
    "Categoria" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE logrosrecursoshumanos OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 26000)
-- Name: metas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE metas (
    "FkFolioProyecto" character varying(7) NOT NULL,
    "Servicio" boolean NOT NULL,
    "Residencia" boolean NOT NULL,
    "Tesis" boolean NOT NULL,
    "Ponencia" boolean NOT NULL,
    "Articulos" boolean NOT NULL,
    "Libros" boolean NOT NULL,
    "PropiedadesIntelectual" character varying(255) NOT NULL,
    "Otros" character varying(255) NOT NULL,
    "PkMetas" integer NOT NULL
);


ALTER TABLE metas OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 26006)
-- Name: metasalcanzadas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE metasalcanzadas (
    "No.Metas" integer NOT NULL,
    "DescripcionActividades" character varying(45) NOT NULL,
    "Alcance" character varying(45) NOT NULL,
    "Observaciones" character varying(500) NOT NULL,
    "InformeGeneral_IdInformeGeneral" integer NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE metasalcanzadas OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 26012)
-- Name: metasalumnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE metasalumnos (
    "idMetasAlumnos" integer NOT NULL,
    "Descripcion" character varying(256),
    "CatMetasAlumno_idMetas" integer NOT NULL,
    "Alumno_NoControl" character varying(9) NOT NULL,
    "Proyecto_FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE metasalumnos OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 26015)
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "metasalumnos_idMetasAlumnos_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "metasalumnos_idMetasAlumnos_seq" OWNER TO postgres;

--
-- TOC entry 2454 (class 0 OID 0)
-- Dependencies: 212
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "metasalumnos_idMetasAlumnos_seq" OWNED BY metasalumnos."idMetasAlumnos";


--
-- TOC entry 213 (class 1259 OID 26017)
-- Name: notificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE notificaciones (
    "IdNotificacion" integer NOT NULL,
    "Receptor" integer NOT NULL,
    "Emisor" integer NOT NULL,
    "Mensaje" character varying(45) NOT NULL,
    "FechaHora" timestamp without time zone NOT NULL,
    estado boolean DEFAULT true,
    vista timestamp without time zone
);


ALTER TABLE notificaciones OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 26021)
-- Name: objetivosalcanzados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE objetivosalcanzados (
    "No.Objetivos" integer NOT NULL,
    "DescripcionActividades" character varying(45) NOT NULL,
    "Alcance" character varying(45) NOT NULL,
    "Observaciones" character varying(500) NOT NULL,
    "InformeGeneral_IdInformeGeneral" integer NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE objetivosalcanzados OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 26027)
-- Name: observaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE observaciones (
    "ObservacionesGestion" character varying(1000),
    "ObservacionesInvestigacion" character varying(1000),
    "ObservacionesComite" character varying(1000),
    "Proyecto_FolioProyecto" character varying(7) NOT NULL,
    "CatObservcaciones_idObservaciones" integer NOT NULL
);


ALTER TABLE observaciones OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 26033)
-- Name: observacionesentregable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE observacionesentregable (
    "Entregable_idEntregable" integer NOT NULL,
    "ObservacionesGestion" character varying(1000),
    "ObservacionesInvestigacion" character varying(1000),
    "ObservacionesComite" character varying(1000),
    "CatObservcaciones_idObservaciones" integer NOT NULL
);


ALTER TABLE observacionesentregable OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 26039)
-- Name: prorroga; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE prorroga (
    "Motivo" character varying(45) NOT NULL,
    tiempo integer,
    "ObsGestion" character varying(512),
    "ObsInv" character varying(512),
    "ObsCom" character varying(512),
    "Proyecto_FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE prorroga OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 26045)
-- Name: proyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE proyecto (
    "FolioProyecto" character varying(7) NOT NULL,
    "idEstado" integer,
    "FechaPresentacion" date NOT NULL,
    "FechaReactivacion" date,
    "PalabraClave1" character varying(45),
    "PalabraClave2" character varying(45),
    "PalabraClave3" character varying(45),
    "Responsable" integer,
    "actividadesResponsable" character varying(256),
    "ConvocatoriaCPR" character varying(45) NOT NULL,
    "TipoInvestigacion" integer NOT NULL,
    "TipoSector" integer NOT NULL,
    "LineaInvestigacion" integer NOT NULL,
    "Inicio" date NOT NULL,
    "Fin" date NOT NULL,
    "NombreProyecto" character varying(45),
    "ObjetivoGeneral" character varying(45),
    "ObjetivoEspecifico" character varying(45),
    "Resultados" character varying(45),
    "Especificar" character varying(500)
);


ALTER TABLE proyecto OWNER TO postgres;

--
-- TOC entry 2455 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN proyecto."Especificar"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN proyecto."Especificar" IS 'especificaciones de el tipo de sector';


--
-- TOC entry 219 (class 1259 OID 26051)
-- Name: proyectoscancelados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE proyectoscancelados (
    "Motivo" character varying(45) NOT NULL,
    "FolioProyecto" character varying(7) NOT NULL,
    "FechaCancelacion" date NOT NULL,
    "ResponsableAnterior" integer
);


ALTER TABLE proyectoscancelados OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 26054)
-- Name: recepcion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE recepcion (
    "No.Solicitud" integer NOT NULL,
    "FechaRecepcion" date NOT NULL,
    "NombreRecibio" character varying(45) NOT NULL,
    "Proyecto_FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE recepcion OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 26057)
-- Name: resultados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE resultados (
    "Resultados" character varying(45) NOT NULL,
    "Anexos" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE resultados OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 26060)
-- Name: resumenejecutivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE resumenejecutivo (
    "Resumen" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE resumenejecutivo OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 26063)
-- Name: sanciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sanciones (
    observacion character varying(512) NOT NULL,
    "no.personal" integer NOT NULL,
    "idCatSancion" integer NOT NULL,
    fecha timestamp without time zone,
    "FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE sanciones OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 26069)
-- Name: tipoinvestigacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipoinvestigacion (
    id integer NOT NULL,
    descripcion character varying(45) NOT NULL
);


ALTER TABLE tipoinvestigacion OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 26072)
-- Name: tiposector; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tiposector (
    id integer NOT NULL,
    descripcion character varying(45)
);


ALTER TABLE tiposector OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 34113)
-- Name: tipousuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipousuario (
    idtipousuario integer NOT NULL,
    descripciontipo character varying(30)
);


ALTER TABLE tipousuario OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 26075)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuario (
    "NoPersonal" integer NOT NULL,
    "Nombre" character varying(45) NOT NULL,
    "ApellidoP" character varying(45) NOT NULL,
    "ApellidoM" character varying(45) NOT NULL,
    "FechaNacimiento" date NOT NULL,
    "Sexo" character varying(1) NOT NULL,
    "CorreoInstitucional" character varying(45) NOT NULL,
    contrasenia character varying(60) NOT NULL,
    "tipoUsuario" integer,
    estado integer
);


ALTER TABLE usuario OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 26078)
-- Name: vinculacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE vinculacion (
    "FolioProyecto" character varying(7) NOT NULL,
    "NombreOrganizacion" character varying(45),
    "Dirección" character varying(45),
    "Area" character varying(45),
    "Telefono" character varying(45),
    "NombreCompleto" character varying(45),
    "DescripcionOrganizacion" character varying(255),
    "DescripcionAportaciones" character varying(255)
);


ALTER TABLE vinculacion OWNER TO postgres;

--
-- TOC entry 2175 (class 2604 OID 26084)
-- Name: carrera idCarrera; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY carrera ALTER COLUMN "idCarrera" SET DEFAULT nextval('"carrera_idCarrera_seq"'::regclass);


--
-- TOC entry 2176 (class 2604 OID 26085)
-- Name: catmetasalumno idMetas; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catmetasalumno ALTER COLUMN "idMetas" SET DEFAULT nextval('"catmetasalumno_idMetas_seq"'::regclass);


--
-- TOC entry 2177 (class 2604 OID 26086)
-- Name: catsancion idCatSancion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catsancion ALTER COLUMN "idCatSancion" SET DEFAULT nextval('"catsancion_idCatSancion_seq"'::regclass);


--
-- TOC entry 2178 (class 2604 OID 26087)
-- Name: entregable idEntregable; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entregable ALTER COLUMN "idEntregable" SET DEFAULT nextval('"entregable_idEntregable_seq"'::regclass);


--
-- TOC entry 2179 (class 2604 OID 26088)
-- Name: estadoproyecto idEstado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estadoproyecto ALTER COLUMN "idEstado" SET DEFAULT nextval('"estadoproyecto_idEstado_seq"'::regclass);


--
-- TOC entry 2180 (class 2604 OID 26089)
-- Name: metasalumnos idMetasAlumnos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metasalumnos ALTER COLUMN "idMetasAlumnos" SET DEFAULT nextval('"metasalumnos_idMetasAlumnos_seq"'::regclass);


--
-- TOC entry 2397 (class 0 OID 25924)
-- Dependencies: 185
-- Data for Name: actividadesproyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2398 (class 0 OID 25930)
-- Dependencies: 186
-- Data for Name: alumno; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis) VALUES ('127O2345', '9', 'JANETH', 'SANCHEZ', 'ORTIZ', 1, 'TRAER LAS TORTAS', 'PRE3', true, true, true);
INSERT INTO alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis) VALUES ('137O1419', '10', 'MIGUEL ANGEL', 'RIVAS', 'VIVEROS', 3, 'PROGRAMAR TODO EL SISTEMA', 'PRE3', true, true, true);


--
-- TOC entry 2440 (class 0 OID 26193)
-- Dependencies: 228
-- Data for Name: alumnoscolaboradoresdetalle; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl") VALUES (1, 'PRE3', '137O1419');
INSERT INTO alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl") VALUES (2, 'PRE3', '127O2345');


--
-- TOC entry 2399 (class 0 OID 25933)
-- Dependencies: 187
-- Data for Name: asesor; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2400 (class 0 OID 25936)
-- Dependencies: 188
-- Data for Name: carrera; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO carrera ("idCarrera", "Descripcion") VALUES (2, 'INgenieria en gestion ');
INSERT INTO carrera ("idCarrera", "Descripcion") VALUES (3, 'ingenieria en sistemas');
INSERT INTO carrera ("idCarrera", "Descripcion") VALUES (1, 'Ingenieria bioquimica');


--
-- TOC entry 2456 (class 0 OID 0)
-- Dependencies: 189
-- Name: carrera_idCarrera_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"carrera_idCarrera_seq"', 1, false);


--
-- TOC entry 2402 (class 0 OID 25941)
-- Dependencies: 190
-- Data for Name: catmetasalumno; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2457 (class 0 OID 0)
-- Dependencies: 191
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"catmetasalumno_idMetas_seq"', 1, false);


--
-- TOC entry 2404 (class 0 OID 25946)
-- Dependencies: 192
-- Data for Name: catobservcaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2405 (class 0 OID 25949)
-- Dependencies: 193
-- Data for Name: catsancion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2458 (class 0 OID 0)
-- Dependencies: 194
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"catsancion_idCatSancion_seq"', 1, false);


--
-- TOC entry 2407 (class 0 OID 25954)
-- Dependencies: 195
-- Data for Name: colaboradordocente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('DISEÑAR RED', 'PRE3', 1254, 'TORRES', 'VERA', 'LICENCIATURA', 0, 'torres@hotmail.com', 'vera@hotmail.com', 3, 'FRANCISCO JAVIER');
INSERT INTO colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('PROGRAMAR ALGO', 'PRE3', 1478, 'LAGUNES ', 'BARRADAS', 'DOCTORADO', 2288447788, 'vicky@hotmail.com', 'lagunes@hotmail.com', 3, 'VIRGINIA');


--
-- TOC entry 2408 (class 0 OID 25960)
-- Dependencies: 196
-- Data for Name: constancias; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2409 (class 0 OID 25963)
-- Dependencies: 197
-- Data for Name: docente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera") VALUES (1, 'Licenciatura', 389967, 3);
INSERT INTO docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera") VALUES (2, 'Licenciatura', 389947, 3);
INSERT INTO docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera") VALUES (6, '1', 312314, 1);
INSERT INTO docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera") VALUES (7, '1', 43253, 1);
INSERT INTO docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera") VALUES (8, '1', 23452, 1);
INSERT INTO docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera") VALUES (10, '1', 4342, 1);
INSERT INTO docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera") VALUES (32, '1', 423423, 1);


--
-- TOC entry 2410 (class 0 OID 25966)
-- Dependencies: 198
-- Data for Name: entregable; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2459 (class 0 OID 0)
-- Dependencies: 199
-- Name: entregable_idEntregable_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"entregable_idEntregable_seq"', 1, false);


--
-- TOC entry 2412 (class 0 OID 25971)
-- Dependencies: 200
-- Data for Name: estadoproyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2460 (class 0 OID 0)
-- Dependencies: 201
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"estadoproyecto_idEstado_seq"', 1, false);


--
-- TOC entry 2414 (class 0 OID 25976)
-- Dependencies: 202
-- Data for Name: etapas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'PRIMERA', '2018-09-28', '2018-09-30', 3, 'AUN FALTA', 'ENTREGAR EN TIEMPO Y FORMA                                                    ', 'PROGRAMAR HASTA MORIR                              ', 'NO HAY                                                    ', 1);
INSERT INTO etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'SEGUNDA', '2018-09-28', '2018-09-30', 2, 'YA FALTA MENOS', 'FECHA DE ENTREGA                                                    ', 'NO HAY POR EL MOMENTO                                                    ', 'PROTOTIPO                                                    ', 2);


--
-- TOC entry 2415 (class 0 OID 25982)
-- Dependencies: 203
-- Data for Name: financiamientorequerido; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO financiamientorequerido ("FolioProyecto", "Financiamiento", "Interno", "Externo", "Especificar", "Infraestructura", "Consumibles", "Licencias", "Viaticos", "Publicaciones", "Equipo", "Patentes", "Otros", "Especifique") VALUES ('PRE3', false, NULL, NULL, NULL, 1.00, 2.00, 2.00, 3.00, 3.00, 3.00, 3.00, 3.00, 'OTRO MÁS');


--
-- TOC entry 2416 (class 0 OID 25985)
-- Dependencies: 204
-- Data for Name: lineainvestigacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO lineainvestigacion (id, descripcion) VALUES (1, 'Informactica');
INSERT INTO lineainvestigacion (id, descripcion) VALUES (2, 'Computo en la nube');


--
-- TOC entry 2417 (class 0 OID 25988)
-- Dependencies: 205
-- Data for Name: logrosconocimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2418 (class 0 OID 25991)
-- Dependencies: 206
-- Data for Name: logrosdivulgacionpublicaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2419 (class 0 OID 25994)
-- Dependencies: 207
-- Data for Name: logrospresentacioneseventos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2420 (class 0 OID 25997)
-- Dependencies: 208
-- Data for Name: logrosrecursoshumanos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2421 (class 0 OID 26000)
-- Dependencies: 209
-- Data for Name: metas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO metas ("FkFolioProyecto", "Servicio", "Residencia", "Tesis", "Ponencia", "Articulos", "Libros", "PropiedadesIntelectual", "Otros", "PkMetas") VALUES ('PRE3', true, true, true, false, false, false, 'INTELIGENTE', '', 1);


--
-- TOC entry 2422 (class 0 OID 26006)
-- Dependencies: 210
-- Data for Name: metasalcanzadas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2423 (class 0 OID 26012)
-- Dependencies: 211
-- Data for Name: metasalumnos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2461 (class 0 OID 0)
-- Dependencies: 212
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"metasalumnos_idMetasAlumnos_seq"', 1, false);


--
-- TOC entry 2425 (class 0 OID 26017)
-- Dependencies: 213
-- Data for Name: notificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2426 (class 0 OID 26021)
-- Dependencies: 214
-- Data for Name: objetivosalcanzados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2427 (class 0 OID 26027)
-- Dependencies: 215
-- Data for Name: observaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2428 (class 0 OID 26033)
-- Dependencies: 216
-- Data for Name: observacionesentregable; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2429 (class 0 OID 26039)
-- Dependencies: 217
-- Data for Name: prorroga; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2430 (class 0 OID 26045)
-- Dependencies: 218
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar") VALUES ('PRE1', NULL, '2018-09-06', NULL, NULL, NULL, NULL, NULL, NULL, 'CPR1', 1, 1, 1, '2018-09-06', '2019-03-06', 'apremat', NULL, NULL, NULL, '');
INSERT INTO proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar") VALUES ('PRE3', NULL, '2018-09-06', NULL, 'COMER', 'MORIR', 'VIVIR', 1, 'DORMIR', 'CPR1', 1, 1, 1, '2018-09-06', '2019-03-06', 'sigue', 'SEGUIR', 'SIGUELE', 'SIGAMOS', '');


--
-- TOC entry 2431 (class 0 OID 26051)
-- Dependencies: 219
-- Data for Name: proyectoscancelados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2432 (class 0 OID 26054)
-- Dependencies: 220
-- Data for Name: recepcion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2433 (class 0 OID 26057)
-- Dependencies: 221
-- Data for Name: resultados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2434 (class 0 OID 26060)
-- Dependencies: 222
-- Data for Name: resumenejecutivo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2435 (class 0 OID 26063)
-- Dependencies: 223
-- Data for Name: sanciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2436 (class 0 OID 26069)
-- Dependencies: 224
-- Data for Name: tipoinvestigacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipoinvestigacion (id, descripcion) VALUES (1, 'investigacion Aplicada');
INSERT INTO tipoinvestigacion (id, descripcion) VALUES (2, 'Investigacion Pura');
INSERT INTO tipoinvestigacion (id, descripcion) VALUES (3, 'Investigacion especial');


--
-- TOC entry 2437 (class 0 OID 26072)
-- Dependencies: 225
-- Data for Name: tiposector; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tiposector (id, descripcion) VALUES (1, 'Publico');
INSERT INTO tiposector (id, descripcion) VALUES (2, 'Privado');


--
-- TOC entry 2441 (class 0 OID 34113)
-- Dependencies: 229
-- Data for Name: tipousuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipousuario (idtipousuario, descripciontipo) VALUES (1, 'Docente');
INSERT INTO tipousuario (idtipousuario, descripciontipo) VALUES (2, 'Gestion');
INSERT INTO tipousuario (idtipousuario, descripciontipo) VALUES (3, 'Investigacion');
INSERT INTO tipousuario (idtipousuario, descripciontipo) VALUES (4, 'Comite');


--
-- TOC entry 2438 (class 0 OID 26075)
-- Dependencies: 226
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (2, 'Miguel', 'Rivas', 'Viveros', '1994-04-03', 'M', 'MiguelAzul@gmail.com', '1234', 1, 1);
INSERT INTO usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (6, 'jose', 'ricardez', 'cruz', '2018-12-31', 'F', 'hector481516@gmail.com', '1234', 1, 1);
INSERT INTO usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (7, 'doris', 'lobato', 'rodriguez', '1982-01-20', 'F', 'tango.lobaro@outlook.com', '1234', 1, 1);
INSERT INTO usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (8, 'norma', 'cruz', 'orozco', '2018-12-31', 'F', 'noriza54@hotmail.com', '1234', 1, 1);
INSERT INTO usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (10, 'Usuario', 'primero', 'segundo', '2018-01-01', 'F', 'correo@hotmail.com', '1234', 1, 2);
INSERT INTO usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (1, 'Hector', 'Ricardez', 'Cruz', '1992-04-11', 'M', 'Hector481516@gmail.com', '4815162342', 1, 1);
INSERT INTO usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (32, 'juan manuel', 'olguin', 'medina', '1962-05-19', 'F', 'otrocorreo@hotmai.com', '1234', 1, 2);


--
-- TOC entry 2439 (class 0 OID 26078)
-- Dependencies: 227
-- Data for Name: vinculacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO vinculacion ("FolioProyecto", "NombreOrganizacion", "Dirección", "Area", "Telefono", "NombreCompleto", "DescripcionOrganizacion", "DescripcionAportaciones") VALUES ('PRE3', 'CHEDRAUI', 'CERCA', 'GRANDE', '2255888445', 'VELAZQUEZ', 'TIENDITA DE LA ESQUINA', 'ME DEPOSITAN CADA MES');


--
-- TOC entry 2183 (class 2606 OID 26091)
-- Name: actividadesproyecto actividadesproyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY actividadesproyecto
    ADD CONSTRAINT "actividadesproyecto_PRIMARY" PRIMARY KEY ("InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2186 (class 2606 OID 26093)
-- Name: alumno alumno_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alumno
    ADD CONSTRAINT "alumno_PRIMARY" PRIMARY KEY ("NoControl");


--
-- TOC entry 2189 (class 2606 OID 26095)
-- Name: asesor asesor_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asesor
    ADD CONSTRAINT "asesor_PRIMARY" PRIMARY KEY ("IdUsuario");


--
-- TOC entry 2191 (class 2606 OID 26097)
-- Name: carrera carrera_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY carrera
    ADD CONSTRAINT "carrera_PRIMARY" PRIMARY KEY ("idCarrera");


--
-- TOC entry 2193 (class 2606 OID 26099)
-- Name: catmetasalumno catmetasalumno_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catmetasalumno
    ADD CONSTRAINT "catmetasalumno_PRIMARY" PRIMARY KEY ("idMetas");


--
-- TOC entry 2195 (class 2606 OID 26101)
-- Name: catobservcaciones catobservcaciones_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catobservcaciones
    ADD CONSTRAINT "catobservcaciones_PRIMARY" PRIMARY KEY ("idObservaciones");


--
-- TOC entry 2197 (class 2606 OID 26103)
-- Name: catsancion catsancion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY catsancion
    ADD CONSTRAINT "catsancion_PRIMARY" PRIMARY KEY ("idCatSancion");


--
-- TOC entry 2199 (class 2606 OID 42306)
-- Name: colaboradordocente colaboradordocente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY colaboradordocente
    ADD CONSTRAINT colaboradordocente_pkey PRIMARY KEY ("Docente_noPersonal");


--
-- TOC entry 2204 (class 2606 OID 26105)
-- Name: docente docente_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docente
    ADD CONSTRAINT "docente_PRIMARY" PRIMARY KEY ("noPersonal");


--
-- TOC entry 2207 (class 2606 OID 26107)
-- Name: entregable entregable_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entregable
    ADD CONSTRAINT "entregable_PRIMARY" PRIMARY KEY ("idEntregable", "Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2210 (class 2606 OID 26109)
-- Name: estadoproyecto estadoproyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estadoproyecto
    ADD CONSTRAINT "estadoproyecto_PRIMARY" PRIMARY KEY ("idEstado");


--
-- TOC entry 2215 (class 2606 OID 26113)
-- Name: financiamientorequerido financiamientorequerido_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY financiamientorequerido
    ADD CONSTRAINT "financiamientorequerido_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2275 (class 2606 OID 34117)
-- Name: tipousuario id_tipo_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipousuario
    ADD CONSTRAINT id_tipo_usuario PRIMARY KEY (idtipousuario);


--
-- TOC entry 2217 (class 2606 OID 26115)
-- Name: lineainvestigacion lineainvestigacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY lineainvestigacion
    ADD CONSTRAINT "lineainvestigacion_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2223 (class 2606 OID 26180)
-- Name: metas metas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metas
    ADD CONSTRAINT metas_pkey PRIMARY KEY ("PkMetas");


--
-- TOC entry 2226 (class 2606 OID 26119)
-- Name: metasalcanzadas metasalcanzadas_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metasalcanzadas
    ADD CONSTRAINT "metasalcanzadas_PRIMARY" PRIMARY KEY ("InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2231 (class 2606 OID 26121)
-- Name: metasalumnos metasalumnos_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metasalumnos
    ADD CONSTRAINT "metasalumnos_PRIMARY" PRIMARY KEY ("idMetasAlumnos");


--
-- TOC entry 2235 (class 2606 OID 26123)
-- Name: notificaciones notificaciones_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notificaciones
    ADD CONSTRAINT "notificaciones_PRIMARY" PRIMARY KEY ("IdNotificacion");


--
-- TOC entry 2238 (class 2606 OID 26125)
-- Name: objetivosalcanzados objetivosalcanzados_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY objetivosalcanzados
    ADD CONSTRAINT "objetivosalcanzados_PRIMARY" PRIMARY KEY ("No.Objetivos", "InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2241 (class 2606 OID 26127)
-- Name: observaciones observaciones_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observaciones
    ADD CONSTRAINT "observaciones_PRIMARY" PRIMARY KEY ("Proyecto_FolioProyecto");


--
-- TOC entry 2245 (class 2606 OID 26129)
-- Name: observacionesentregable observacionesentregable_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY observacionesentregable
    ADD CONSTRAINT "observacionesentregable_PRIMARY" PRIMARY KEY ("Entregable_idEntregable");


--
-- TOC entry 2273 (class 2606 OID 26199)
-- Name: alumnoscolaboradoresdetalle pk_alumno_col_detalle; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alumnoscolaboradoresdetalle
    ADD CONSTRAINT pk_alumno_col_detalle PRIMARY KEY (pkdetalle_alumnocoldetalle);


--
-- TOC entry 2213 (class 2606 OID 26187)
-- Name: etapas pk_etapas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY etapas
    ADD CONSTRAINT pk_etapas PRIMARY KEY ("PkEtapas");


--
-- TOC entry 2253 (class 2606 OID 26131)
-- Name: proyecto proyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT "proyecto_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2255 (class 2606 OID 26133)
-- Name: proyectoscancelados proyectoscancelados_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectoscancelados
    ADD CONSTRAINT "proyectoscancelados_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2258 (class 2606 OID 26135)
-- Name: recepcion recepcion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recepcion
    ADD CONSTRAINT "recepcion_PRIMARY" PRIMARY KEY ("No.Solicitud", "Proyecto_FolioProyecto");


--
-- TOC entry 2265 (class 2606 OID 26137)
-- Name: tipoinvestigacion tipoinvestigacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipoinvestigacion
    ADD CONSTRAINT "tipoinvestigacion_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2267 (class 2606 OID 26139)
-- Name: tiposector tiposector_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tiposector
    ADD CONSTRAINT "tiposector_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2269 (class 2606 OID 26141)
-- Name: usuario usuario_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT "usuario_PRIMARY" PRIMARY KEY ("NoPersonal");


--
-- TOC entry 2271 (class 2606 OID 26143)
-- Name: vinculacion vinculacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vinculacion
    ADD CONSTRAINT "vinculacion_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2232 (class 1259 OID 26144)
-- Name: Emi_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "Emi_idx" ON notificaciones USING btree ("Emisor");


--
-- TOC entry 2233 (class 1259 OID 26145)
-- Name: Rece_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "Rece_idx" ON notificaciones USING btree ("Receptor");


--
-- TOC entry 2184 (class 1259 OID 26146)
-- Name: fk_ActividadesProyecto_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ActividadesProyecto_Entregable1_idx" ON actividadesproyecto USING btree ("Entregable_idEntregable");


--
-- TOC entry 2187 (class 1259 OID 26147)
-- Name: fk_Alumno_Carrera1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Alumno_Carrera1_idx" ON alumno USING btree (id_carrera);


--
-- TOC entry 2200 (class 1259 OID 26148)
-- Name: fk_ColaboradorDocente_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ColaboradorDocente_Docente1_idx" ON colaboradordocente USING btree ("Docente_noPersonal");


--
-- TOC entry 2201 (class 1259 OID 26149)
-- Name: fk_ColaboradorDocente_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ColaboradorDocente_Proyecto1_idx" ON colaboradordocente USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2202 (class 1259 OID 26150)
-- Name: fk_Constancias_Etapas1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Constancias_Etapas1_idx" ON constancias USING btree ("Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2205 (class 1259 OID 26151)
-- Name: fk_Docente_Carrera1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Docente_Carrera1_idx" ON docente USING btree ("Carrera_idCarrera");


--
-- TOC entry 2208 (class 1259 OID 26152)
-- Name: fk_Entregable_Etapas1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Entregable_Etapas1_idx" ON entregable USING btree ("Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2211 (class 1259 OID 26153)
-- Name: fk_Etapas_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Etapas_Proyecto1_idx" ON etapas USING btree ("FolioProyecto");


--
-- TOC entry 2218 (class 1259 OID 26154)
-- Name: fk_LogrosConocimiento_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosConocimiento_Entregable1_idx" ON logrosconocimiento USING btree ("Entregable_idEntregable");


--
-- TOC entry 2219 (class 1259 OID 26155)
-- Name: fk_LogrosDivulgacionPublicaciones_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosDivulgacionPublicaciones_Entregable1_idx" ON logrosdivulgacionpublicaciones USING btree ("Entregable_idEntregable");


--
-- TOC entry 2220 (class 1259 OID 26156)
-- Name: fk_LogrosPresentacionesEventos_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosPresentacionesEventos_Entregable1_idx" ON logrospresentacioneseventos USING btree ("Entregable_idEntregable");


--
-- TOC entry 2221 (class 1259 OID 26157)
-- Name: fk_LogrosRecursosHumanos_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosRecursosHumanos_Entregable1_idx" ON logrosrecursoshumanos USING btree ("Entregable_idEntregable");


--
-- TOC entry 2224 (class 1259 OID 26158)
-- Name: fk_MetasAlcanzadas_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlcanzadas_Entregable1_idx" ON metasalcanzadas USING btree ("Entregable_idEntregable");


--
-- TOC entry 2227 (class 1259 OID 26159)
-- Name: fk_MetasAlumnos_Alumno1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_Alumno1_idx" ON metasalumnos USING btree ("Alumno_NoControl");


--
-- TOC entry 2228 (class 1259 OID 26160)
-- Name: fk_MetasAlumnos_CatMetasAlumno1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_CatMetasAlumno1_idx" ON metasalumnos USING btree ("CatMetasAlumno_idMetas");


--
-- TOC entry 2229 (class 1259 OID 26161)
-- Name: fk_MetasAlumnos_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_Proyecto1_idx" ON metasalumnos USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2236 (class 1259 OID 26162)
-- Name: fk_ObjetivosAlcanzados_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ObjetivosAlcanzados_Entregable1_idx" ON objetivosalcanzados USING btree ("Entregable_idEntregable");


--
-- TOC entry 2242 (class 1259 OID 26163)
-- Name: fk_ObservacionesEntregable_CatObservcaciones1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ObservacionesEntregable_CatObservcaciones1_idx" ON observacionesentregable USING btree ("CatObservcaciones_idObservaciones");


--
-- TOC entry 2243 (class 1259 OID 26164)
-- Name: fk_Observaciones_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Observaciones_Entregable1_idx" ON observacionesentregable USING btree ("Entregable_idEntregable");


--
-- TOC entry 2239 (class 1259 OID 26165)
-- Name: fk_Observaciones_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Observaciones_Proyecto1_idx" ON observaciones USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2246 (class 1259 OID 26166)
-- Name: fk_Prorroga_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Prorroga_Proyecto1_idx" ON prorroga USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2247 (class 1259 OID 26167)
-- Name: fk_Proyecto_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Proyecto_Docente1_idx" ON proyecto USING btree ("Responsable");


--
-- TOC entry 2248 (class 1259 OID 26168)
-- Name: fk_Proyecto_EstadoProyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Proyecto_EstadoProyecto1_idx" ON proyecto USING btree ("idEstado");


--
-- TOC entry 2256 (class 1259 OID 26169)
-- Name: fk_Recepcion_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Recepcion_Proyecto1_idx" ON recepcion USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2259 (class 1259 OID 26170)
-- Name: fk_Resultados_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Resultados_Entregable1_idx" ON resultados USING btree ("Entregable_idEntregable");


--
-- TOC entry 2260 (class 1259 OID 26171)
-- Name: fk_ResumenEjecutivo_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ResumenEjecutivo_Entregable1_idx" ON resumenejecutivo USING btree ("Entregable_idEntregable");


--
-- TOC entry 2261 (class 1259 OID 26172)
-- Name: fk_Sanciones_CatSancion1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_CatSancion1_idx" ON sanciones USING btree ("idCatSancion");


--
-- TOC entry 2262 (class 1259 OID 26173)
-- Name: fk_Sanciones_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_Docente1_idx" ON sanciones USING btree ("no.personal");


--
-- TOC entry 2263 (class 1259 OID 26174)
-- Name: fk_Sanciones_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_Proyecto1_idx" ON sanciones USING btree ("FolioProyecto");


--
-- TOC entry 2249 (class 1259 OID 26175)
-- Name: fk_linea_investigacion_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_linea_investigacion_idx ON proyecto USING btree ("LineaInvestigacion");


--
-- TOC entry 2250 (class 1259 OID 26176)
-- Name: fk_tipo_investigacion_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_tipo_investigacion_idx ON proyecto USING btree ("TipoInvestigacion");


--
-- TOC entry 2251 (class 1259 OID 26177)
-- Name: fk_tipo_sector_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_tipo_sector_idx ON proyecto USING btree ("TipoSector");


--
-- TOC entry 2276 (class 2606 OID 26188)
-- Name: etapas fk_folio_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY etapas
    ADD CONSTRAINT fk_folio_proyecto FOREIGN KEY ("FolioProyecto") REFERENCES proyecto("FolioProyecto");


--
-- TOC entry 2279 (class 2606 OID 26205)
-- Name: alumnoscolaboradoresdetalle fk_folio_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alumnoscolaboradoresdetalle
    ADD CONSTRAINT fk_folio_proyecto FOREIGN KEY (folioproyecto) REFERENCES proyecto("FolioProyecto");


--
-- TOC entry 2277 (class 2606 OID 26181)
-- Name: metas fk_folio_proyectos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metas
    ADD CONSTRAINT fk_folio_proyectos FOREIGN KEY ("FkFolioProyecto") REFERENCES proyecto("FolioProyecto");


--
-- TOC entry 2278 (class 2606 OID 26200)
-- Name: alumnoscolaboradoresdetalle fk_no_control_alumno; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alumnoscolaboradoresdetalle
    ADD CONSTRAINT fk_no_control_alumno FOREIGN KEY ("FkNoControl") REFERENCES alumno("NoControl");


-- Completed on 2018-09-08 22:03:04

--
-- PostgreSQL database dump complete
--

