--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 9.6.10

-- Started on 2018-11-27 10:42:10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2484 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 185 (class 1259 OID 33358)
-- Name: actividadesproyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.actividadesproyecto (
    "No.Actividad" integer NOT NULL,
    "DescripcionActividades" character varying(45) NOT NULL,
    "Alcance" character varying(45) NOT NULL,
    "Observaciones" character varying(500) NOT NULL,
    "InformeGeneral_IdInformeGeneral" integer NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE public.actividadesproyecto OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 33364)
-- Name: alumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumno (
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
    tesis boolean,
    estado integer,
    genero "char"
);


ALTER TABLE public.alumno OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 33367)
-- Name: alumnoscolaboradoresdetalle; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumnoscolaboradoresdetalle (
    pkdetalle_alumnocoldetalle integer NOT NULL,
    folioproyecto character varying(7),
    "FkNoControl" character varying(9),
    servicio bit(1),
    residencia bit(1),
    tesis bit(1),
    semestre integer,
    actividades character varying(255)
);


ALTER TABLE public.alumnoscolaboradoresdetalle OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 33370)
-- Name: asesor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.asesor (
    "IdUsuario" integer NOT NULL,
    "GradoMaximoEstudios" character varying(45),
    "TelefonoMovil" integer,
    "DescripcionPrincipalesActividadesProyecto" character varying(45)
);


ALTER TABLE public.asesor OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 33712)
-- Name: cambioAlumnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."cambioAlumnos" (
    id_solicitud integer NOT NULL,
    id_alum character varying(20) NOT NULL,
    folio_proyecto character varying(50) NOT NULL,
    id_tipo_cambio integer NOT NULL,
    motivo character varying(200),
    nc_reemplazo character varying(20),
    fecha_peticion date DEFAULT now(),
    semestre integer,
    servic bit(1) DEFAULT B'0'::"bit" NOT NULL,
    resid bit(1) DEFAULT B'0'::"bit" NOT NULL,
    tesis bit(1) DEFAULT B'0'::"bit" NOT NULL,
    actividades_actuales character varying(255),
    id_estado integer
);


ALTER TABLE public."cambioAlumnos" OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 33710)
-- Name: cambioAlumnos_id_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."cambioAlumnos_id_solicitud_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."cambioAlumnos_id_solicitud_seq" OWNER TO postgres;

--
-- TOC entry 2485 (class 0 OID 0)
-- Dependencies: 233
-- Name: cambioAlumnos_id_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."cambioAlumnos_id_solicitud_seq" OWNED BY public."cambioAlumnos".id_solicitud;


--
-- TOC entry 232 (class 1259 OID 33688)
-- Name: cambioColaboradores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."cambioColaboradores" (
    id_solicitud integer NOT NULL,
    id_doc integer NOT NULL,
    folio_proyecto character varying(20) NOT NULL,
    id_tipo_cambio integer NOT NULL,
    motivo character varying(200),
    np_reemplazo integer,
    fecha_peticion date DEFAULT now(),
    actividades_actuales character varying(255),
    id_estado integer
);


ALTER TABLE public."cambioColaboradores" OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 33686)
-- Name: cambioColaboradores2_id_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."cambioColaboradores2_id_solicitud_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."cambioColaboradores2_id_solicitud_seq" OWNER TO postgres;

--
-- TOC entry 2486 (class 0 OID 0)
-- Dependencies: 231
-- Name: cambioColaboradores2_id_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."cambioColaboradores2_id_solicitud_seq" OWNED BY public."cambioColaboradores".id_solicitud;


--
-- TOC entry 189 (class 1259 OID 33373)
-- Name: carrera; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.carrera (
    "idCarrera" integer NOT NULL,
    "Descripcion" character varying(60)
);


ALTER TABLE public.carrera OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 33376)
-- Name: carrera_idCarrera_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."carrera_idCarrera_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."carrera_idCarrera_seq" OWNER TO postgres;

--
-- TOC entry 2487 (class 0 OID 0)
-- Dependencies: 190
-- Name: carrera_idCarrera_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."carrera_idCarrera_seq" OWNED BY public.carrera."idCarrera";


--
-- TOC entry 191 (class 1259 OID 33378)
-- Name: cat_estadoproyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cat_estadoproyecto (
    "idEstado" integer NOT NULL,
    "Descripcion" character varying(45)
);


ALTER TABLE public.cat_estadoproyecto OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 33381)
-- Name: cat_tipos_solicitudes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cat_tipos_solicitudes (
    id integer NOT NULL,
    descripcion character varying(50) NOT NULL
);


ALTER TABLE public.cat_tipos_solicitudes OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 33384)
-- Name: catmetasalumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.catmetasalumno (
    "idMetas" integer NOT NULL,
    "Descripcion" character varying(10)
);


ALTER TABLE public.catmetasalumno OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 33387)
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."catmetasalumno_idMetas_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."catmetasalumno_idMetas_seq" OWNER TO postgres;

--
-- TOC entry 2488 (class 0 OID 0)
-- Dependencies: 194
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."catmetasalumno_idMetas_seq" OWNED BY public.catmetasalumno."idMetas";


--
-- TOC entry 195 (class 1259 OID 33389)
-- Name: catobservaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.catobservaciones (
    "idObservaciones" integer NOT NULL,
    "Descripcion" character varying(45) NOT NULL
);


ALTER TABLE public.catobservaciones OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 33392)
-- Name: catsancion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.catsancion (
    "idCatSancion" integer NOT NULL,
    "Descripcion" character varying(45)
);


ALTER TABLE public.catsancion OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 33395)
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."catsancion_idCatSancion_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."catsancion_idCatSancion_seq" OWNER TO postgres;

--
-- TOC entry 2489 (class 0 OID 0)
-- Dependencies: 197
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."catsancion_idCatSancion_seq" OWNED BY public.catsancion."idCatSancion";


--
-- TOC entry 198 (class 1259 OID 33397)
-- Name: colaboradordocente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.colaboradordocente (
    "Actividades" character varying(512) NOT NULL,
    "Proyecto_FolioProyecto" character varying(7) NOT NULL,
    "Docente_noPersonal" integer NOT NULL,
    ap_paterno character varying(15),
    ap_materno character varying,
    grado_max_estudios character varying(15),
    celular bigint,
    correo_institucional character varying(50),
    correo_alternativo character varying(100),
    id_carrera integer,
    nombre character varying(30)
);


ALTER TABLE public.colaboradordocente OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 33403)
-- Name: constancias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.constancias (
    "FolioConstancias" character varying(10) NOT NULL,
    "Fecha" date NOT NULL,
    "Mensaje" character varying(45) NOT NULL,
    "TipoConstancia" character varying(45) NOT NULL,
    "Etapas_FolioProyecto" character varying(7) NOT NULL,
    "Etapas_noEtapa" integer NOT NULL
);


ALTER TABLE public.constancias OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 33406)
-- Name: docente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.docente (
    "noPersonal" integer NOT NULL,
    "GradoMaximoEstudios" character varying(45) NOT NULL,
    "TelefonoMovil" integer NOT NULL,
    "Carrera_idCarrera" integer NOT NULL,
    correo_alternativo character varying(100)
);


ALTER TABLE public.docente OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 33409)
-- Name: entregable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.entregable (
    "idEntregable" integer NOT NULL,
    "FechaEntrega" date NOT NULL,
    "Observaciones" character varying(45) NOT NULL,
    "Etapas_FolioProyecto" character varying(7) NOT NULL,
    "Etapas_noEtapa" integer NOT NULL,
    "Estatus" integer
);


ALTER TABLE public.entregable OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 33412)
-- Name: entregable_idEntregable_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."entregable_idEntregable_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."entregable_idEntregable_seq" OWNER TO postgres;

--
-- TOC entry 2490 (class 0 OID 0)
-- Dependencies: 202
-- Name: entregable_idEntregable_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."entregable_idEntregable_seq" OWNED BY public.entregable."idEntregable";


--
-- TOC entry 203 (class 1259 OID 33414)
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."estadoproyecto_idEstado_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."estadoproyecto_idEstado_seq" OWNER TO postgres;

--
-- TOC entry 2491 (class 0 OID 0)
-- Dependencies: 203
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."estadoproyecto_idEstado_seq" OWNED BY public.cat_estadoproyecto."idEstado";


--
-- TOC entry 204 (class 1259 OID 33416)
-- Name: etapas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etapas (
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


ALTER TABLE public.etapas OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 33422)
-- Name: financiamientorequerido; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.financiamientorequerido (
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


ALTER TABLE public.financiamientorequerido OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 33429)
-- Name: lineainvestigacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lineainvestigacion (
    id integer NOT NULL,
    descripcion character varying(45)
);


ALTER TABLE public.lineainvestigacion OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 33432)
-- Name: logrosconocimiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.logrosconocimiento (
    "Entregable_idEntregable" integer NOT NULL,
    "PatentableDesarrollo" boolean,
    "InfraestructuraTecnologica" boolean,
    "AvancesConocimientoCientifico" boolean,
    "PatentableInfraest" boolean,
    "PatentableCientif" boolean
);


ALTER TABLE public.logrosconocimiento OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 33435)
-- Name: logrosdivulgacionpublicaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.logrosdivulgacionpublicaciones (
    "TipoPublicacion" character varying(45) NOT NULL,
    "NombrePublicacion" character varying(45) NOT NULL,
    "Lugar" character varying(45) NOT NULL,
    "Fecha" date NOT NULL,
    "Entregable_idEntregable" integer NOT NULL,
    "TituloDelArticulo" character varying
);


ALTER TABLE public.logrosdivulgacionpublicaciones OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 33441)
-- Name: logrospresentacioneseventos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.logrospresentacioneseventos (
    "TituloPonencia" character varying(45),
    "TipoDePonencia" character varying(45),
    "NombreEvento" character varying(45),
    "Lugar" character varying(45),
    "Fecha" date NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE public.logrospresentacioneseventos OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 33444)
-- Name: logrosrecursoshumanos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.logrosrecursoshumanos (
    "NombreTrabajo" character varying(45),
    "Categoria" character varying(45),
    "Entregable_idEntregable" integer NOT NULL,
    "FkNoControl" character varying(45)
);


ALTER TABLE public.logrosrecursoshumanos OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 33447)
-- Name: metas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.metas (
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


ALTER TABLE public.metas OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 33453)
-- Name: metasalcanzadas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.metasalcanzadas (
    "No.Metas" integer NOT NULL,
    "DescripcionActividades" character varying(45) NOT NULL,
    "Alcance" character varying(45) NOT NULL,
    "Observaciones" character varying(500) NOT NULL,
    "InformeGeneral_IdInformeGeneral" integer NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE public.metasalcanzadas OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 33459)
-- Name: metasalumnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.metasalumnos (
    "idMetasAlumnos" integer NOT NULL,
    "Descripcion" character varying(256),
    "CatMetasAlumno_idMetas" integer NOT NULL,
    "Alumno_NoControl" character varying(9) NOT NULL,
    "Proyecto_FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE public.metasalumnos OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 33462)
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."metasalumnos_idMetasAlumnos_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."metasalumnos_idMetasAlumnos_seq" OWNER TO postgres;

--
-- TOC entry 2492 (class 0 OID 0)
-- Dependencies: 214
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."metasalumnos_idMetasAlumnos_seq" OWNED BY public.metasalumnos."idMetasAlumnos";


--
-- TOC entry 215 (class 1259 OID 33464)
-- Name: notificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notificaciones (
    "IdNotificacion" integer NOT NULL,
    "Receptor" integer NOT NULL,
    "Emisor" integer NOT NULL,
    "Mensaje" character varying(45) NOT NULL,
    "FechaHora" timestamp without time zone NOT NULL,
    estado boolean DEFAULT true,
    vista timestamp without time zone
);


ALTER TABLE public.notificaciones OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 33468)
-- Name: objetivosalcanzados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.objetivosalcanzados (
    "No.Objetivos" integer NOT NULL,
    "DescripcionActividades" character varying(45) NOT NULL,
    "Alcance" character varying(45) NOT NULL,
    "Observaciones" character varying(500) NOT NULL,
    "InformeGeneral_IdInformeGeneral" integer NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE public.objetivosalcanzados OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 33474)
-- Name: observaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.observaciones (
    "ObservacionesGestion" character varying(1000),
    "ObservacionesInvestigacion" character varying(1000),
    "ObservacionesComite" character varying(1000),
    "CatObservaciones_idObservaciones" integer NOT NULL,
    "Proyecto_FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE public.observaciones OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 33480)
-- Name: observacionesentregable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.observacionesentregable (
    "Entregable_idEntregable" integer NOT NULL,
    "InformeGeneral" character varying(1000),
    "InformeDetallado" character varying(1000),
    "ResumenEjecutivo" character varying(1000),
    "CatObservcaciones_idObservaciones" integer NOT NULL,
    "Departamento" integer
);


ALTER TABLE public.observacionesentregable OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 33486)
-- Name: prorroga; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prorroga (
    "Motivo" character varying(50) NOT NULL,
    tiempo integer,
    "ObsGestion" character varying(512),
    "ObsInv" character varying(512),
    "ObsCom" character varying(512),
    "Proyecto_FolioProyecto" character varying(7) NOT NULL,
    "Razones" character varying(255) NOT NULL,
    fecha_solicitud date,
    id_docente integer NOT NULL,
    otro_especifique character varying(50),
    etapa_solicitada integer
);


ALTER TABLE public.prorroga OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 33492)
-- Name: proyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proyecto (
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
    "ObjetivoGeneral" character varying(512),
    "ObjetivoEspecifico" character varying(512),
    "Resultados" character varying(512),
    "Especificar" character varying(500),
    "NoRevision" integer
);


ALTER TABLE public.proyecto OWNER TO postgres;

--
-- TOC entry 2493 (class 0 OID 0)
-- Dependencies: 220
-- Name: COLUMN proyecto."Especificar"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.proyecto."Especificar" IS 'especificaciones de el tipo de sector';


--
-- TOC entry 221 (class 1259 OID 33498)
-- Name: proyectoscancelados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proyectoscancelados (
    "Motivo" character varying(45) NOT NULL,
    "FolioProyecto" character varying(7) NOT NULL,
    "FechaCancelacion" date NOT NULL,
    "ResponsableAnterior" integer
);


ALTER TABLE public.proyectoscancelados OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 33501)
-- Name: recepcion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recepcion (
    "No.Solicitud" integer NOT NULL,
    "FechaRecepcion" date NOT NULL,
    "NombreRecibio" character varying(45) NOT NULL,
    "Proyecto_FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE public.recepcion OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 33504)
-- Name: resultados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultados (
    "Resultados" character varying(45) NOT NULL,
    "Anexos" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE public.resultados OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 33507)
-- Name: resumenejecutivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resumenejecutivo (
    "Resumen" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL,
    "Comentarios" character varying(500)
);


ALTER TABLE public.resumenejecutivo OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 33513)
-- Name: sanciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sanciones (
    observacion character varying(512) NOT NULL,
    "no.personal" integer NOT NULL,
    "idCatSancion" integer NOT NULL,
    fecha timestamp without time zone,
    "FolioProyecto" character varying(7) NOT NULL
);


ALTER TABLE public.sanciones OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 33519)
-- Name: tipoinvestigacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipoinvestigacion (
    id integer NOT NULL,
    descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tipoinvestigacion OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 33522)
-- Name: tiposector; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tiposector (
    id integer NOT NULL,
    descripcion character varying(45)
);


ALTER TABLE public.tiposector OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 33525)
-- Name: tipousuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipousuario (
    idtipousuario integer NOT NULL,
    descripciontipo character varying(30)
);


ALTER TABLE public.tipousuario OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 33528)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
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


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 33531)
-- Name: vinculacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vinculacion (
    "FolioProyecto" character varying(7) NOT NULL,
    "NombreOrganizacion" character varying(45),
    "Dirección" character varying(45),
    "Area" character varying(45),
    "Telefono" character varying(45),
    "NombreCompleto" character varying(45),
    "DescripcionOrganizacion" character varying(256),
    "DescripcionAportaciones" character varying(256)
);


ALTER TABLE public.vinculacion OWNER TO postgres;

--
-- TOC entry 2203 (class 2604 OID 33715)
-- Name: cambioAlumnos id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioAlumnos" ALTER COLUMN id_solicitud SET DEFAULT nextval('public."cambioAlumnos_id_solicitud_seq"'::regclass);


--
-- TOC entry 2201 (class 2604 OID 33691)
-- Name: cambioColaboradores id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioColaboradores" ALTER COLUMN id_solicitud SET DEFAULT nextval('public."cambioColaboradores2_id_solicitud_seq"'::regclass);


--
-- TOC entry 2194 (class 2604 OID 33537)
-- Name: carrera idCarrera; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carrera ALTER COLUMN "idCarrera" SET DEFAULT nextval('public."carrera_idCarrera_seq"'::regclass);


--
-- TOC entry 2195 (class 2604 OID 33538)
-- Name: cat_estadoproyecto idEstado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cat_estadoproyecto ALTER COLUMN "idEstado" SET DEFAULT nextval('public."estadoproyecto_idEstado_seq"'::regclass);


--
-- TOC entry 2196 (class 2604 OID 33539)
-- Name: catmetasalumno idMetas; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catmetasalumno ALTER COLUMN "idMetas" SET DEFAULT nextval('public."catmetasalumno_idMetas_seq"'::regclass);


--
-- TOC entry 2197 (class 2604 OID 33540)
-- Name: catsancion idCatSancion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catsancion ALTER COLUMN "idCatSancion" SET DEFAULT nextval('public."catsancion_idCatSancion_seq"'::regclass);


--
-- TOC entry 2198 (class 2604 OID 33541)
-- Name: entregable idEntregable; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entregable ALTER COLUMN "idEntregable" SET DEFAULT nextval('public."entregable_idEntregable_seq"'::regclass);


--
-- TOC entry 2199 (class 2604 OID 33542)
-- Name: metasalumnos idMetasAlumnos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metasalumnos ALTER COLUMN "idMetasAlumnos" SET DEFAULT nextval('public."metasalumnos_idMetasAlumnos_seq"'::regclass);


--
-- TOC entry 2427 (class 0 OID 33358)
-- Dependencies: 185
-- Data for Name: actividadesproyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2428 (class 0 OID 33364)
-- Dependencies: 186
-- Data for Name: alumno; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('117O4525', '9', 'FERNANDO', 'JUAN', 'LUNA', 3, 'DESARROLLAR EL PROTOTIPO FUNCIONAL', 'PRE3', true, true, false, 1, 'M');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('117O1234', '7', 'MARIA', 'GOMEZ', 'PALACIOS', 1, 'DORMIR', 'PRE3', true, false, true, 6, 'F');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('127O1254', '7', 'MARIO', 'GÓMEZ', 'FERNÁNDEZ', 1, 'OBTENER TODOS LOS REQUERIMIENTOS DEL SISTEMA', 'PRE3', true, false, false, 1, 'M');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('127O0949', '8', 'LENAE', 'PORTILLA', 'AHUMADA', 1, 'INVENTARIO DE LA TIENDITA', 'PRE4', true, true, false, 7, 'F');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('137O1419', '10', 'MIGUEL ANGEL', 'RIVAS', 'VIVEROS', 3, 'PROGRAMAR TODO EL SISTEMA', 'PRE3', true, true, true, 1, 'M');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('127O2345', '9', 'JANETH', 'SANCHEZ', 'ORTIZ', 1, 'TRAER LAS TORTAS', 'PRE3', true, true, true, 7, 'F');


--
-- TOC entry 2429 (class 0 OID 33367)
-- Dependencies: 187
-- Data for Name: alumnoscolaboradoresdetalle; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (1, 'PRE3', '137O1419', B'1', B'1', B'1', 9, 'DISEÑAR INTERFACES');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (2, 'PRE3', '127O2345', B'1', B'1', B'1', 10, 'REALIZAR PRUEBAS');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (5, 'PRE3', '117O4525', B'1', B'1', B'0', 9, 'EXAMINAR CODIGO');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (6, 'PRE3', '127O1254', B'1', B'0', B'0', 10, 'ANALISIS DE REQUERIMIENTOS');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (4, 'PRE3', '117O1234', B'1', B'0', B'1', 10, 'HACER ALGO');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (3, 'PRE4', '127O0949', B'1', B'0', B'0', 9, 'DISEÑAR LA BASE DE DATOS');


--
-- TOC entry 2430 (class 0 OID 33370)
-- Dependencies: 188
-- Data for Name: asesor; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2476 (class 0 OID 33712)
-- Dependencies: 234
-- Data for Name: cambioAlumnos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."cambioAlumnos" (id_solicitud, id_alum, folio_proyecto, id_tipo_cambio, motivo, nc_reemplazo, fecha_peticion, semestre, servic, resid, tesis, actividades_actuales, id_estado) VALUES (2, '127O0949', 'PRE4', 6, 'El cambio se realiza porque el alumno anterior tiene que salir del país', '127O2345', '2018-11-24', 7, B'0', B'0', B'0', 'DISEÑAR LA BASE DE DATOS', 12);
INSERT INTO public."cambioAlumnos" (id_solicitud, id_alum, folio_proyecto, id_tipo_cambio, motivo, nc_reemplazo, fecha_peticion, semestre, servic, resid, tesis, actividades_actuales, id_estado) VALUES (1, '117O1234', 'PRE4', 4, NULL, NULL, '2018-11-24', 7, B'0', B'0', B'0', 'REALIZAR DIAGRAMA DE CLASES', 12);


--
-- TOC entry 2494 (class 0 OID 0)
-- Dependencies: 233
-- Name: cambioAlumnos_id_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."cambioAlumnos_id_solicitud_seq"', 2, true);


--
-- TOC entry 2474 (class 0 OID 33688)
-- Dependencies: 232
-- Data for Name: cambioColaboradores; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."cambioColaboradores" (id_solicitud, id_doc, folio_proyecto, id_tipo_cambio, motivo, np_reemplazo, fecha_peticion, actividades_actuales, id_estado) VALUES (1, 32, 'PRE4', 2, 'El docente anterior tuve que salir de viaje a Europa', 5, '2018-11-24', 'CHECAR EL CÓDIGO', 12);
INSERT INTO public."cambioColaboradores" (id_solicitud, id_doc, folio_proyecto, id_tipo_cambio, motivo, np_reemplazo, fecha_peticion, actividades_actuales, id_estado) VALUES (3, 8, 'PRE4', 1, NULL, NULL, '2018-11-24', 'REALIZAR DIAGRAMAS DE CLASE', 12);
INSERT INTO public."cambioColaboradores" (id_solicitud, id_doc, folio_proyecto, id_tipo_cambio, motivo, np_reemplazo, fecha_peticion, actividades_actuales, id_estado) VALUES (2, 1, 'PRE4', 3, 'Porque ya no trabaja', NULL, '2018-11-24', NULL, 15);


--
-- TOC entry 2495 (class 0 OID 0)
-- Dependencies: 231
-- Name: cambioColaboradores2_id_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."cambioColaboradores2_id_solicitud_seq"', 3, true);


--
-- TOC entry 2431 (class 0 OID 33373)
-- Dependencies: 189
-- Data for Name: carrera; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.carrera ("idCarrera", "Descripcion") VALUES (2, 'INgenieria en gestion ');
INSERT INTO public.carrera ("idCarrera", "Descripcion") VALUES (3, 'ingenieria en sistemas');
INSERT INTO public.carrera ("idCarrera", "Descripcion") VALUES (1, 'Ingenieria bioquimica');


--
-- TOC entry 2496 (class 0 OID 0)
-- Dependencies: 190
-- Name: carrera_idCarrera_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."carrera_idCarrera_seq"', 1, false);


--
-- TOC entry 2433 (class 0 OID 33378)
-- Dependencies: 191
-- Data for Name: cat_estadoproyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (2, 'EN REVISION');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (1, 'EN CORRECCION');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (3, 'ACEPTADO');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (4, 'RECHAZADO');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (5, 'EN REVISION INV.');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (6, 'EN PRORROGA');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (7, 'EN PRORROGA INV.');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (8, 'EN PRORROGA COM.');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (9, 'PRORROGA A');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (10, 'PRORROGA R');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (11, 'EN PRORROGA C-I');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (12, 'CC PENDIENTE');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (13, 'CC OBSERVACIONES');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (14, 'CC RECHAZADO');
INSERT INTO public.cat_estadoproyecto ("idEstado", "Descripcion") VALUES (15, 'CC ACEPTADO');


--
-- TOC entry 2434 (class 0 OID 33381)
-- Dependencies: 192
-- Data for Name: cat_tipos_solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (1, 'Alta colaborador');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (2, 'Cambio colaborador');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (3, 'Baja colaborador');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (4, 'Alta alumno');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (5, 'Cambio alumno');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (6, 'Baja alumno');


--
-- TOC entry 2435 (class 0 OID 33384)
-- Dependencies: 193
-- Data for Name: catmetasalumno; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2497 (class 0 OID 0)
-- Dependencies: 194
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."catmetasalumno_idMetas_seq"', 1, false);


--
-- TOC entry 2437 (class 0 OID 33389)
-- Dependencies: 195
-- Data for Name: catobservaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (1, 'Proyecto');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (3, 'Colaboradores');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (4, 'Objetivos');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (5, 'Vinculacion');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (6, 'Metas');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (7, 'Etapas');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (8, 'Financiamiento');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (9, 'Alumnos');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (2, 'Responsable');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (10, 'Prorroga');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (11, 'AltaC');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (12, 'CambioC');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (13, 'BajaC');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (14, 'AltaCA');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (15, 'CambioCA');
INSERT INTO public.catobservaciones ("idObservaciones", "Descripcion") VALUES (16, 'BajaCA');


--
-- TOC entry 2438 (class 0 OID 33392)
-- Dependencies: 196
-- Data for Name: catsancion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2498 (class 0 OID 0)
-- Dependencies: 197
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."catsancion_idCatSancion_seq"', 1, false);


--
-- TOC entry 2440 (class 0 OID 33397)
-- Dependencies: 198
-- Data for Name: colaboradordocente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('DISEÑAR RED', 'PRE3', 4, 'TORRES', 'VERA', 'LICENCIATURA', 0, 'torres@hotmail.com', 'vera@hotmail.com', 3, 'FRANCISCO JAVIER');
INSERT INTO public.colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('DISEÑAR LA BASE DE DATOS DEL SISTEMAS', 'PRE3', 3, 'OLGUÍN ', 'MEDINA', 'Licenciatura', 0, 'olguin@hotmail.com', '', 3, 'JUAN MANUEL');
INSERT INTO public.colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('PROGRAMAR ALGO', 'PRE3', 5, 'LAGUNES ', 'BARRADAS', 'DOCTORADO', 2288447788, 'vicky@hotmail.com', 'lagunes@hotmail.com', 3, 'VIRGINIA');
INSERT INTO public.colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('CHECAR EL CÓDIGO', 'PRE4', 32, 'LÓPEZ', 'LEAL', 'DOCTORADO', 0, 'leal@hotmail.com', '', 3, 'RAÚL');
INSERT INTO public.colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('REALIZAR CHECKLIST', 'PRE2', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('COMPROBAR REQUERIMIENTOS', 'PRE1', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO public.colaboradordocente ("Actividades", "Proyecto_FolioProyecto", "Docente_noPersonal", ap_paterno, ap_materno, grado_max_estudios, celular, correo_institucional, correo_alternativo, id_carrera, nombre) VALUES ('COMPRAR EQUIPO', 'PRE2', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 2441 (class 0 OID 33403)
-- Dependencies: 199
-- Data for Name: constancias; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2442 (class 0 OID 33406)
-- Dependencies: 200
-- Data for Name: docente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera", correo_alternativo) VALUES (1, 'Licenciatura', 389967, 3, 'correo1@hotmail.com
');
INSERT INTO public.docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera", correo_alternativo) VALUES (3, 'Licenciatura', 389947, 3, 'correo3@hotmail.com');
INSERT INTO public.docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera", correo_alternativo) VALUES (2, 'Doctorado', 312314, 1, 'correo2@hotmail.com');
INSERT INTO public.docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera", correo_alternativo) VALUES (5, 'Licenciatura', 43253, 1, 'correo4@hotmail.com');
INSERT INTO public.docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera", correo_alternativo) VALUES (10, 'Doctorado', 4342, 1, 'correo6@hotmail.com');
INSERT INTO public.docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera", correo_alternativo) VALUES (8, 'Maestría', 23452, 1, 'correo5@hotmail.com');
INSERT INTO public.docente ("noPersonal", "GradoMaximoEstudios", "TelefonoMovil", "Carrera_idCarrera", correo_alternativo) VALUES (32, 'Licenciatura', 423423, 1, 'correo7@hotmail.com');


--
-- TOC entry 2443 (class 0 OID 33409)
-- Dependencies: 201
-- Data for Name: entregable; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.entregable ("idEntregable", "FechaEntrega", "Observaciones", "Etapas_FolioProyecto", "Etapas_noEtapa", "Estatus") VALUES (1, '2018-05-15', 'Entrega correcta', 'PRE4', 2, 1);


--
-- TOC entry 2499 (class 0 OID 0)
-- Dependencies: 202
-- Name: entregable_idEntregable_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."entregable_idEntregable_seq"', 1, false);


--
-- TOC entry 2500 (class 0 OID 0)
-- Dependencies: 203
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."estadoproyecto_idEstado_seq"', 1, false);


--
-- TOC entry 2446 (class 0 OID 33416)
-- Dependencies: 204
-- Data for Name: etapas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'PRIMERA', '2018-09-28', '2018-09-30', 3, 'AUN FALTA', 'ENTREGAR EN TIEMPO Y FORMA                                                    ', 'PROGRAMAR HASTA MORIR                              ', 'NO HAY                                                    ', 1);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'SEGUNDA', '2018-09-28', '2018-09-30', 2, 'YA FALTA MENOS', 'FECHA DE ENTREGA                                                    ', 'NO HAY POR EL MOMENTO                                                    ', 'PROTOTIPO                                                    ', 2);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'AGE ONE ', '2018-09-18', '2018-09-30', 2, 'EN ESTA ETAPA VAMOS A PENSAR EN LO QUE VAMOS A HACER', 'ENTREGAR EN TIEMPO Y FORMA', 'HACER LOS DIAGRAMAS DE CASOS DE USO                                   ', 'AÚN NO HAY ALGUNO                                          ', 3);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'AGE TWO', '2018-09-18', '2018-10-31', 5, 'EN ESTA ETAPA YA VAMOS A ESTAR EN DESARROLLO', 'ENTREGAR UN PROTOTIPO                                                    ', 'PROGRAMAR TODO EL PROTOTIPO            ', 'PROTOTIPO FUNCIONAL', 4);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE4', 1, 'PRIMERA', '2018-09-28', '2018-09-30', 3, 'AUN FALTA', 'ENTREGAR EN TIEMPO Y FORMA', 'PROGRAMAR HASTA MORIR', 'NO HAY', 6);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE4', 2, 'ENTREGA 1', '2018-10-31', '2019-03-31', 5, 'ENTREGA FINAL', 'DESARROLLAR UN SISTEMA                      ', 'HACER TODO   ', 'UN ERP PARA LA TIENDITA                               ', 5);


--
-- TOC entry 2447 (class 0 OID 33422)
-- Dependencies: 205
-- Data for Name: financiamientorequerido; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.financiamientorequerido ("FolioProyecto", "Financiamiento", "Interno", "Externo", "Especificar", "Infraestructura", "Consumibles", "Licencias", "Viaticos", "Publicaciones", "Equipo", "Patentes", "Otros", "Especifique") VALUES ('PRE3', false, NULL, NULL, NULL, 1.00, 2.00, 2.00, 3.00, 3.00, 3.00, 3.00, 3.00, 'OTRO MÁS');
INSERT INTO public.financiamientorequerido ("FolioProyecto", "Financiamiento", "Interno", "Externo", "Especificar", "Infraestructura", "Consumibles", "Licencias", "Viaticos", "Publicaciones", "Equipo", "Patentes", "Otros", "Especifique") VALUES ('PRE4', true, false, true, 'EL ITSX ME VA A PAGAR LOS CAMIONES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 2448 (class 0 OID 33429)
-- Dependencies: 206
-- Data for Name: lineainvestigacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.lineainvestigacion (id, descripcion) VALUES (1, 'Informactica');
INSERT INTO public.lineainvestigacion (id, descripcion) VALUES (2, 'Computo en la nube');


--
-- TOC entry 2449 (class 0 OID 33432)
-- Dependencies: 207
-- Data for Name: logrosconocimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2450 (class 0 OID 33435)
-- Dependencies: 208
-- Data for Name: logrosdivulgacionpublicaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2451 (class 0 OID 33441)
-- Dependencies: 209
-- Data for Name: logrospresentacioneseventos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2452 (class 0 OID 33444)
-- Dependencies: 210
-- Data for Name: logrosrecursoshumanos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2453 (class 0 OID 33447)
-- Dependencies: 211
-- Data for Name: metas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.metas ("FkFolioProyecto", "Servicio", "Residencia", "Tesis", "Ponencia", "Articulos", "Libros", "PropiedadesIntelectual", "Otros", "PkMetas") VALUES ('PRE4', true, true, false, false, false, false, '', '', 2);
INSERT INTO public.metas ("FkFolioProyecto", "Servicio", "Residencia", "Tesis", "Ponencia", "Articulos", "Libros", "PropiedadesIntelectual", "Otros", "PkMetas") VALUES ('PRE3', true, true, true, false, false, false, 'INTELIGENTE', '', 1);


--
-- TOC entry 2454 (class 0 OID 33453)
-- Dependencies: 212
-- Data for Name: metasalcanzadas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2455 (class 0 OID 33459)
-- Dependencies: 213
-- Data for Name: metasalumnos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2501 (class 0 OID 0)
-- Dependencies: 214
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."metasalumnos_idMetasAlumnos_seq"', 1, false);


--
-- TOC entry 2457 (class 0 OID 33464)
-- Dependencies: 215
-- Data for Name: notificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2458 (class 0 OID 33468)
-- Dependencies: 216
-- Data for Name: objetivosalcanzados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2459 (class 0 OID 33474)
-- Dependencies: 217
-- Data for Name: observaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('', NULL, NULL, 1, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('', NULL, NULL, 2, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('', NULL, NULL, 3, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('NO SE HAN DECLARADO', NULL, NULL, 4, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('', NULL, NULL, 5, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('', NULL, NULL, 6, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('AGREGA OTRA ETAPA COMO MÍNIMO', NULL, NULL, 7, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('', NULL, NULL, 8, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('', NULL, NULL, 9, 'PRE4');
INSERT INTO public.observaciones ("ObservacionesGestion", "ObservacionesInvestigacion", "ObservacionesComite", "CatObservaciones_idObservaciones", "Proyecto_FolioProyecto") VALUES ('¿Cómo ves Kori?', 'Como tú veas ', NULL, 13, 'PRE4');


--
-- TOC entry 2460 (class 0 OID 33480)
-- Dependencies: 218
-- Data for Name: observacionesentregable; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2461 (class 0 OID 33486)
-- Dependencies: 219
-- Data for Name: prorroga; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.prorroga ("Motivo", tiempo, "ObsGestion", "ObsInv", "ObsCom", "Proyecto_FolioProyecto", "Razones", fecha_solicitud, id_docente, otro_especifique, etapa_solicitada) VALUES ('Otro', NULL, NULL, NULL, NULL, 'PRE4', 'Tengo gripe crónica', '2018-10-07', 1, 'Me duele la cabeza', 2);


--
-- TOC entry 2462 (class 0 OID 33492)
-- Dependencies: 220
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar", "NoRevision") VALUES ('PRE3', 2, '2018-09-06', NULL, 'programa', 'inteligencia', 'artificial', 1, 'diseñar interfaces', 'CPR1', 1, 1, 1, '2018-09-06', '2019-03-06', 'sigue', 'CONTRUIR ALGO', 'ANALIZAR
DISEÑAR
PROGRAMAR', 'UN SISTEMA EFICIENTE', '', 1);
INSERT INTO public.proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar", "NoRevision") VALUES ('PRE1', NULL, '2018-09-06', NULL, NULL, NULL, NULL, NULL, NULL, 'CPR1', 1, 1, 1, '2018-09-06', '2019-03-06', 'apremat', NULL, NULL, NULL, '', 1);
INSERT INTO public.proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar", "NoRevision") VALUES ('PRE4', 1, '2018-09-19', NULL, 'PUNTO', 'VENTA', 'ERP', 2, 'ANALIZAR, DISEÑAR Y PROGRAMAR', 'CPR1', 1, 2, 1, '2018-10-01', '2019-03-31', 'ERP TIENDITA', 'ANALIZAR, DISEÑAR, PROGRAMAR Y PROBAR', 'UN ERP PARA LA TIENDITA', 'UN ERP PARA UN PUNTO DE VENTA', '', 1);


--
-- TOC entry 2463 (class 0 OID 33498)
-- Dependencies: 221
-- Data for Name: proyectoscancelados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2464 (class 0 OID 33501)
-- Dependencies: 222
-- Data for Name: recepcion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2465 (class 0 OID 33504)
-- Dependencies: 223
-- Data for Name: resultados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2466 (class 0 OID 33507)
-- Dependencies: 224
-- Data for Name: resumenejecutivo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2467 (class 0 OID 33513)
-- Dependencies: 225
-- Data for Name: sanciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2468 (class 0 OID 33519)
-- Dependencies: 226
-- Data for Name: tipoinvestigacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tipoinvestigacion (id, descripcion) VALUES (1, 'investigacion Aplicada');
INSERT INTO public.tipoinvestigacion (id, descripcion) VALUES (2, 'Investigacion Pura');
INSERT INTO public.tipoinvestigacion (id, descripcion) VALUES (3, 'Investigacion especial');


--
-- TOC entry 2469 (class 0 OID 33522)
-- Dependencies: 227
-- Data for Name: tiposector; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tiposector (id, descripcion) VALUES (1, 'Publico');
INSERT INTO public.tiposector (id, descripcion) VALUES (2, 'Privado');


--
-- TOC entry 2470 (class 0 OID 33525)
-- Dependencies: 228
-- Data for Name: tipousuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (1, 'Docente');
INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (2, 'Gestion');
INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (3, 'Investigacion');
INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (4, 'Comite');


--
-- TOC entry 2471 (class 0 OID 33528)
-- Dependencies: 229
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (10, 'Usuario', 'primero', 'segundo', '2018-01-01', 'F', 'correo@hotmail.com', '1234', 1, 2);
INSERT INTO public.usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (3, 'Miguel', 'Rivas', 'Viveros', '1994-04-03', 'M', 'MiguelAzul@gmail.com', '1234', 2, 1);
INSERT INTO public.usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (2, 'jose', 'ricardez', 'cruz', '2018-12-31', 'F', 'hector481516@gmail.com', '1234', 1, 1);
INSERT INTO public.usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (32, 'juan manuel', 'olguin', 'medina', '1962-05-19', 'F', 'otrocorreo@hotmai.com', '1234', 1, 4);
INSERT INTO public.usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (5, 'doris', 'lobato', 'rodriguez', '1982-01-20', 'F', 'tango.lobaro@outlook.com', '1234', 1, 4);
INSERT INTO public.usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (8, 'norma', 'cruz', 'orozco', '2018-12-31', 'F', 'noriza54@hotmail.com', '1234', 1, 3);
INSERT INTO public.usuario ("NoPersonal", "Nombre", "ApellidoP", "ApellidoM", "FechaNacimiento", "Sexo", "CorreoInstitucional", contrasenia, "tipoUsuario", estado) VALUES (1, 'Hector', 'Ricardez', 'Cruz', '1992-04-11', 'M', 'Hector481516@gmail.com', '4815162342', 1, 1);


--
-- TOC entry 2472 (class 0 OID 33531)
-- Dependencies: 230
-- Data for Name: vinculacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.vinculacion ("FolioProyecto", "NombreOrganizacion", "Dirección", "Area", "Telefono", "NombreCompleto", "DescripcionOrganizacion", "DescripcionAportaciones") VALUES ('PRE3', 'CHEDRAUI', 'CERCA', 'GRANDE', '2255888445', 'VELAZQUEZ', 'TIENDITA DE LA ESQUINA', 'ME DEPOSITAN CADA MES');
INSERT INTO public.vinculacion ("FolioProyecto", "NombreOrganizacion", "Dirección", "Area", "Telefono", "NombreCompleto", "DescripcionOrganizacion", "DescripcionAportaciones") VALUES ('PRE4', 'GOBIERNO DEL ESTADO', 'ENRIQUE SEGOVIANO', 'INFORMÁTICA', '123456', 'PEDRO DAMIÁN LÓPEZ', 'ES UNA INSTITUCIÓN GUBERNAMENTAL', '');


--
-- TOC entry 2209 (class 2606 OID 33544)
-- Name: actividadesproyecto actividadesproyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actividadesproyecto
    ADD CONSTRAINT "actividadesproyecto_PRIMARY" PRIMARY KEY ("InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2212 (class 2606 OID 33546)
-- Name: alumno alumno_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno
    ADD CONSTRAINT "alumno_PRIMARY" PRIMARY KEY ("NoControl");


--
-- TOC entry 2217 (class 2606 OID 33548)
-- Name: asesor asesor_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asesor
    ADD CONSTRAINT "asesor_PRIMARY" PRIMARY KEY ("IdUsuario");


--
-- TOC entry 2305 (class 2606 OID 33724)
-- Name: cambioAlumnos cambioAlumnos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioAlumnos"
    ADD CONSTRAINT "cambioAlumnos_pkey" PRIMARY KEY (id_solicitud);


--
-- TOC entry 2303 (class 2606 OID 33694)
-- Name: cambioColaboradores cambioColaboradores2_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioColaboradores"
    ADD CONSTRAINT "cambioColaboradores2_pkey" PRIMARY KEY (id_solicitud);


--
-- TOC entry 2219 (class 2606 OID 33550)
-- Name: carrera carrera_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carrera
    ADD CONSTRAINT "carrera_PRIMARY" PRIMARY KEY ("idCarrera");


--
-- TOC entry 2223 (class 2606 OID 33552)
-- Name: cat_tipos_solicitudes cat_tipos_solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cat_tipos_solicitudes
    ADD CONSTRAINT cat_tipos_solicitudes_pkey PRIMARY KEY (id);


--
-- TOC entry 2225 (class 2606 OID 33554)
-- Name: catmetasalumno catmetasalumno_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catmetasalumno
    ADD CONSTRAINT "catmetasalumno_PRIMARY" PRIMARY KEY ("idMetas");


--
-- TOC entry 2227 (class 2606 OID 33556)
-- Name: catobservaciones catobservcaciones_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catobservaciones
    ADD CONSTRAINT "catobservcaciones_PRIMARY" PRIMARY KEY ("idObservaciones");


--
-- TOC entry 2229 (class 2606 OID 33558)
-- Name: catsancion catsancion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catsancion
    ADD CONSTRAINT "catsancion_PRIMARY" PRIMARY KEY ("idCatSancion");


--
-- TOC entry 2231 (class 2606 OID 33560)
-- Name: colaboradordocente colaboradordocente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colaboradordocente
    ADD CONSTRAINT colaboradordocente_pkey PRIMARY KEY ("Docente_noPersonal");


--
-- TOC entry 2236 (class 2606 OID 33562)
-- Name: docente docente_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docente
    ADD CONSTRAINT "docente_PRIMARY" PRIMARY KEY ("noPersonal");


--
-- TOC entry 2239 (class 2606 OID 33564)
-- Name: entregable entregable_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entregable
    ADD CONSTRAINT "entregable_PRIMARY" PRIMARY KEY ("idEntregable", "Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2221 (class 2606 OID 33566)
-- Name: cat_estadoproyecto estadoproyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cat_estadoproyecto
    ADD CONSTRAINT "estadoproyecto_PRIMARY" PRIMARY KEY ("idEstado");


--
-- TOC entry 2245 (class 2606 OID 33568)
-- Name: financiamientorequerido financiamientorequerido_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.financiamientorequerido
    ADD CONSTRAINT "financiamientorequerido_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2297 (class 2606 OID 33570)
-- Name: tipousuario id_tipo_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipousuario
    ADD CONSTRAINT id_tipo_usuario PRIMARY KEY (idtipousuario);


--
-- TOC entry 2247 (class 2606 OID 33572)
-- Name: lineainvestigacion lineainvestigacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lineainvestigacion
    ADD CONSTRAINT "lineainvestigacion_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2249 (class 2606 OID 33574)
-- Name: logrosconocimiento logrosconocimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.logrosconocimiento
    ADD CONSTRAINT logrosconocimiento_pkey PRIMARY KEY ("Entregable_idEntregable");


--
-- TOC entry 2254 (class 2606 OID 33576)
-- Name: metas metas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metas
    ADD CONSTRAINT metas_pkey PRIMARY KEY ("PkMetas");


--
-- TOC entry 2257 (class 2606 OID 33578)
-- Name: metasalcanzadas metasalcanzadas_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metasalcanzadas
    ADD CONSTRAINT "metasalcanzadas_PRIMARY" PRIMARY KEY ("InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2262 (class 2606 OID 33580)
-- Name: metasalumnos metasalumnos_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metasalumnos
    ADD CONSTRAINT "metasalumnos_PRIMARY" PRIMARY KEY ("idMetasAlumnos");


--
-- TOC entry 2266 (class 2606 OID 33582)
-- Name: notificaciones notificaciones_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificaciones
    ADD CONSTRAINT "notificaciones_PRIMARY" PRIMARY KEY ("IdNotificacion");


--
-- TOC entry 2269 (class 2606 OID 33584)
-- Name: objetivosalcanzados objetivosalcanzados_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.objetivosalcanzados
    ADD CONSTRAINT "objetivosalcanzados_PRIMARY" PRIMARY KEY ("No.Objetivos", "InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2273 (class 2606 OID 33586)
-- Name: observacionesentregable observacionesentregable_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.observacionesentregable
    ADD CONSTRAINT "observacionesentregable_PRIMARY" PRIMARY KEY ("Entregable_idEntregable");


--
-- TOC entry 2215 (class 2606 OID 33588)
-- Name: alumnoscolaboradoresdetalle pk_alumno_col_detalle; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnoscolaboradoresdetalle
    ADD CONSTRAINT pk_alumno_col_detalle PRIMARY KEY (pkdetalle_alumnocoldetalle);


--
-- TOC entry 2243 (class 2606 OID 33590)
-- Name: etapas pk_etapas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas
    ADD CONSTRAINT pk_etapas PRIMARY KEY ("PkEtapas");


--
-- TOC entry 2281 (class 2606 OID 33592)
-- Name: proyecto proyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT "proyecto_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2283 (class 2606 OID 33594)
-- Name: proyectoscancelados proyectoscancelados_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyectoscancelados
    ADD CONSTRAINT "proyectoscancelados_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2286 (class 2606 OID 33596)
-- Name: recepcion recepcion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recepcion
    ADD CONSTRAINT "recepcion_PRIMARY" PRIMARY KEY ("No.Solicitud", "Proyecto_FolioProyecto");


--
-- TOC entry 2293 (class 2606 OID 33598)
-- Name: tipoinvestigacion tipoinvestigacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipoinvestigacion
    ADD CONSTRAINT "tipoinvestigacion_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2295 (class 2606 OID 33600)
-- Name: tiposector tiposector_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tiposector
    ADD CONSTRAINT "tiposector_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2299 (class 2606 OID 33602)
-- Name: usuario usuario_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT "usuario_PRIMARY" PRIMARY KEY ("NoPersonal");


--
-- TOC entry 2301 (class 2606 OID 33604)
-- Name: vinculacion vinculacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vinculacion
    ADD CONSTRAINT "vinculacion_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2263 (class 1259 OID 33605)
-- Name: Emi_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "Emi_idx" ON public.notificaciones USING btree ("Emisor");


--
-- TOC entry 2264 (class 1259 OID 33606)
-- Name: Rece_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "Rece_idx" ON public.notificaciones USING btree ("Receptor");


--
-- TOC entry 2210 (class 1259 OID 33607)
-- Name: fk_ActividadesProyecto_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ActividadesProyecto_Entregable1_idx" ON public.actividadesproyecto USING btree ("Entregable_idEntregable");


--
-- TOC entry 2213 (class 1259 OID 33608)
-- Name: fk_Alumno_Carrera1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Alumno_Carrera1_idx" ON public.alumno USING btree (id_carrera);


--
-- TOC entry 2232 (class 1259 OID 33609)
-- Name: fk_ColaboradorDocente_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ColaboradorDocente_Docente1_idx" ON public.colaboradordocente USING btree ("Docente_noPersonal");


--
-- TOC entry 2233 (class 1259 OID 33610)
-- Name: fk_ColaboradorDocente_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ColaboradorDocente_Proyecto1_idx" ON public.colaboradordocente USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2234 (class 1259 OID 33611)
-- Name: fk_Constancias_Etapas1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Constancias_Etapas1_idx" ON public.constancias USING btree ("Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2237 (class 1259 OID 33612)
-- Name: fk_Docente_Carrera1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Docente_Carrera1_idx" ON public.docente USING btree ("Carrera_idCarrera");


--
-- TOC entry 2240 (class 1259 OID 33613)
-- Name: fk_Entregable_Etapas1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Entregable_Etapas1_idx" ON public.entregable USING btree ("Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2241 (class 1259 OID 33614)
-- Name: fk_Etapas_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Etapas_Proyecto1_idx" ON public.etapas USING btree ("FolioProyecto");


--
-- TOC entry 2250 (class 1259 OID 33615)
-- Name: fk_LogrosDivulgacionPublicaciones_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosDivulgacionPublicaciones_Entregable1_idx" ON public.logrosdivulgacionpublicaciones USING btree ("Entregable_idEntregable");


--
-- TOC entry 2251 (class 1259 OID 33616)
-- Name: fk_LogrosPresentacionesEventos_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosPresentacionesEventos_Entregable1_idx" ON public.logrospresentacioneseventos USING btree ("Entregable_idEntregable");


--
-- TOC entry 2252 (class 1259 OID 33617)
-- Name: fk_LogrosRecursosHumanos_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosRecursosHumanos_Entregable1_idx" ON public.logrosrecursoshumanos USING btree ("Entregable_idEntregable");


--
-- TOC entry 2255 (class 1259 OID 33618)
-- Name: fk_MetasAlcanzadas_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlcanzadas_Entregable1_idx" ON public.metasalcanzadas USING btree ("Entregable_idEntregable");


--
-- TOC entry 2258 (class 1259 OID 33619)
-- Name: fk_MetasAlumnos_Alumno1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_Alumno1_idx" ON public.metasalumnos USING btree ("Alumno_NoControl");


--
-- TOC entry 2259 (class 1259 OID 33620)
-- Name: fk_MetasAlumnos_CatMetasAlumno1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_CatMetasAlumno1_idx" ON public.metasalumnos USING btree ("CatMetasAlumno_idMetas");


--
-- TOC entry 2260 (class 1259 OID 33621)
-- Name: fk_MetasAlumnos_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_Proyecto1_idx" ON public.metasalumnos USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2267 (class 1259 OID 33622)
-- Name: fk_ObjetivosAlcanzados_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ObjetivosAlcanzados_Entregable1_idx" ON public.objetivosalcanzados USING btree ("Entregable_idEntregable");


--
-- TOC entry 2270 (class 1259 OID 33623)
-- Name: fk_ObservacionesEntregable_CatObservcaciones1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ObservacionesEntregable_CatObservcaciones1_idx" ON public.observacionesentregable USING btree ("CatObservcaciones_idObservaciones");


--
-- TOC entry 2271 (class 1259 OID 33624)
-- Name: fk_Observaciones_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Observaciones_Entregable1_idx" ON public.observacionesentregable USING btree ("Entregable_idEntregable");


--
-- TOC entry 2274 (class 1259 OID 33625)
-- Name: fk_Prorroga_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Prorroga_Proyecto1_idx" ON public.prorroga USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2275 (class 1259 OID 33626)
-- Name: fk_Proyecto_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Proyecto_Docente1_idx" ON public.proyecto USING btree ("Responsable");


--
-- TOC entry 2276 (class 1259 OID 33627)
-- Name: fk_Proyecto_EstadoProyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Proyecto_EstadoProyecto1_idx" ON public.proyecto USING btree ("idEstado");


--
-- TOC entry 2284 (class 1259 OID 33628)
-- Name: fk_Recepcion_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Recepcion_Proyecto1_idx" ON public.recepcion USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2287 (class 1259 OID 33629)
-- Name: fk_Resultados_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Resultados_Entregable1_idx" ON public.resultados USING btree ("Entregable_idEntregable");


--
-- TOC entry 2288 (class 1259 OID 33630)
-- Name: fk_ResumenEjecutivo_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ResumenEjecutivo_Entregable1_idx" ON public.resumenejecutivo USING btree ("Entregable_idEntregable");


--
-- TOC entry 2289 (class 1259 OID 33631)
-- Name: fk_Sanciones_CatSancion1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_CatSancion1_idx" ON public.sanciones USING btree ("idCatSancion");


--
-- TOC entry 2290 (class 1259 OID 33632)
-- Name: fk_Sanciones_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_Docente1_idx" ON public.sanciones USING btree ("no.personal");


--
-- TOC entry 2291 (class 1259 OID 33633)
-- Name: fk_Sanciones_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_Proyecto1_idx" ON public.sanciones USING btree ("FolioProyecto");


--
-- TOC entry 2277 (class 1259 OID 33634)
-- Name: fk_linea_investigacion_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_linea_investigacion_idx ON public.proyecto USING btree ("LineaInvestigacion");


--
-- TOC entry 2278 (class 1259 OID 33635)
-- Name: fk_tipo_investigacion_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_tipo_investigacion_idx ON public.proyecto USING btree ("TipoInvestigacion");


--
-- TOC entry 2279 (class 1259 OID 33636)
-- Name: fk_tipo_sector_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_tipo_sector_idx ON public.proyecto USING btree ("TipoSector");


--
-- TOC entry 2308 (class 2606 OID 33637)
-- Name: etapas fk_folio_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas
    ADD CONSTRAINT fk_folio_proyecto FOREIGN KEY ("FolioProyecto") REFERENCES public.proyecto("FolioProyecto");


--
-- TOC entry 2306 (class 2606 OID 33642)
-- Name: alumnoscolaboradoresdetalle fk_folio_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnoscolaboradoresdetalle
    ADD CONSTRAINT fk_folio_proyecto FOREIGN KEY (folioproyecto) REFERENCES public.proyecto("FolioProyecto");


--
-- TOC entry 2309 (class 2606 OID 33647)
-- Name: metas fk_folio_proyectos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metas
    ADD CONSTRAINT fk_folio_proyectos FOREIGN KEY ("FkFolioProyecto") REFERENCES public.proyecto("FolioProyecto");


--
-- TOC entry 2307 (class 2606 OID 33652)
-- Name: alumnoscolaboradoresdetalle fk_no_control_alumno; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnoscolaboradoresdetalle
    ADD CONSTRAINT fk_no_control_alumno FOREIGN KEY ("FkNoControl") REFERENCES public.alumno("NoControl");


-- Completed on 2018-11-27 10:42:12

--
-- PostgreSQL database dump complete
--

