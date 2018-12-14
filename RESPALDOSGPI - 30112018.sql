--
-- PostgreSQL database dump
--

-- Dumped from database version 10.5
-- Dumped by pg_dump version 10.5

-- Started on 2018-11-30 20:14:50

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
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 3167 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 17906)
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
-- TOC entry 197 (class 1259 OID 17912)
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
-- TOC entry 198 (class 1259 OID 17915)
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
-- TOC entry 199 (class 1259 OID 17918)
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
-- TOC entry 200 (class 1259 OID 17921)
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
-- TOC entry 201 (class 1259 OID 17931)
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
-- TOC entry 3168 (class 0 OID 0)
-- Dependencies: 201
-- Name: cambioAlumnos_id_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."cambioAlumnos_id_solicitud_seq" OWNED BY public."cambioAlumnos".id_solicitud;


--
-- TOC entry 202 (class 1259 OID 17933)
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
-- TOC entry 203 (class 1259 OID 17937)
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
-- TOC entry 3169 (class 0 OID 0)
-- Dependencies: 203
-- Name: cambioColaboradores2_id_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."cambioColaboradores2_id_solicitud_seq" OWNED BY public."cambioColaboradores".id_solicitud;


--
-- TOC entry 204 (class 1259 OID 17939)
-- Name: carrera; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.carrera (
    "idCarrera" integer NOT NULL,
    "Descripcion" character varying(60)
);


ALTER TABLE public.carrera OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 17942)
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
-- TOC entry 3170 (class 0 OID 0)
-- Dependencies: 205
-- Name: carrera_idCarrera_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."carrera_idCarrera_seq" OWNED BY public.carrera."idCarrera";


--
-- TOC entry 206 (class 1259 OID 17944)
-- Name: cat_estadoproyecto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cat_estadoproyecto (
    "idEstado" integer NOT NULL,
    "Descripcion" character varying(45)
);


ALTER TABLE public.cat_estadoproyecto OWNER TO postgres;

--
-- TOC entry 246 (class 1259 OID 18229)
-- Name: cat_sanciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cat_sanciones (
    id_sancion smallint NOT NULL,
    tipo_sancion character varying(30) NOT NULL
);


ALTER TABLE public.cat_sanciones OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 17947)
-- Name: cat_tipos_solicitudes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cat_tipos_solicitudes (
    id integer NOT NULL,
    descripcion character varying(50) NOT NULL
);


ALTER TABLE public.cat_tipos_solicitudes OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 17950)
-- Name: catmetasalumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.catmetasalumno (
    "idMetas" integer NOT NULL,
    "Descripcion" character varying(10)
);


ALTER TABLE public.catmetasalumno OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 17953)
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
-- TOC entry 3171 (class 0 OID 0)
-- Dependencies: 209
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."catmetasalumno_idMetas_seq" OWNED BY public.catmetasalumno."idMetas";


--
-- TOC entry 210 (class 1259 OID 17955)
-- Name: catobservaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.catobservaciones (
    "idObservaciones" integer NOT NULL,
    "Descripcion" character varying(45) NOT NULL
);


ALTER TABLE public.catobservaciones OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 17958)
-- Name: catsancion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.catsancion (
    "idCatSancion" integer NOT NULL,
    "Descripcion" character varying(45)
);


ALTER TABLE public.catsancion OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 17961)
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
-- TOC entry 3172 (class 0 OID 0)
-- Dependencies: 212
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."catsancion_idCatSancion_seq" OWNED BY public.catsancion."idCatSancion";


--
-- TOC entry 213 (class 1259 OID 17963)
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
-- TOC entry 214 (class 1259 OID 17969)
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
-- TOC entry 215 (class 1259 OID 17972)
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
-- TOC entry 216 (class 1259 OID 17975)
-- Name: entregable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.entregable (
    "idEntregable" integer NOT NULL,
    "FechaEntrega" date NOT NULL,
    "Observaciones" character varying(45) NOT NULL,
    "Etapas_FolioProyecto" character varying(7) NOT NULL,
    "Etapas_noEtapa" integer NOT NULL,
    "Estatus" integer,
    "FechaEntregada" date
);


ALTER TABLE public.entregable OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 17978)
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
-- TOC entry 3173 (class 0 OID 0)
-- Dependencies: 217
-- Name: entregable_idEntregable_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."entregable_idEntregable_seq" OWNED BY public.entregable."idEntregable";


--
-- TOC entry 218 (class 1259 OID 17980)
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
-- TOC entry 3174 (class 0 OID 0)
-- Dependencies: 218
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."estadoproyecto_idEstado_seq" OWNED BY public.cat_estadoproyecto."idEstado";


--
-- TOC entry 219 (class 1259 OID 17982)
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
-- TOC entry 220 (class 1259 OID 17988)
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
-- TOC entry 221 (class 1259 OID 17991)
-- Name: lineainvestigacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lineainvestigacion (
    id integer NOT NULL,
    descripcion character varying(45)
);


ALTER TABLE public.lineainvestigacion OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 17994)
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
-- TOC entry 223 (class 1259 OID 17997)
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
-- TOC entry 224 (class 1259 OID 18003)
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
-- TOC entry 225 (class 1259 OID 18006)
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
-- TOC entry 226 (class 1259 OID 18009)
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
-- TOC entry 227 (class 1259 OID 18015)
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
-- TOC entry 228 (class 1259 OID 18021)
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
-- TOC entry 229 (class 1259 OID 18024)
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
-- TOC entry 3175 (class 0 OID 0)
-- Dependencies: 229
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."metasalumnos_idMetasAlumnos_seq" OWNED BY public.metasalumnos."idMetasAlumnos";


--
-- TOC entry 230 (class 1259 OID 18026)
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
-- TOC entry 231 (class 1259 OID 18030)
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
-- TOC entry 232 (class 1259 OID 18036)
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
-- TOC entry 233 (class 1259 OID 18042)
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
-- TOC entry 234 (class 1259 OID 18048)
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
    fecha_solicitud date NOT NULL,
    id_docente integer NOT NULL,
    otro_especifique character varying(50),
    etapa_solicitada integer NOT NULL
);


ALTER TABLE public.prorroga OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 18054)
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
-- TOC entry 3176 (class 0 OID 0)
-- Dependencies: 235
-- Name: COLUMN proyecto."Especificar"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.proyecto."Especificar" IS 'especificaciones de el tipo de sector';


--
-- TOC entry 236 (class 1259 OID 18060)
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
-- TOC entry 237 (class 1259 OID 18063)
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
-- TOC entry 238 (class 1259 OID 18066)
-- Name: resultados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultados (
    "Resultados" character varying(45) NOT NULL,
    "Anexos" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL
);


ALTER TABLE public.resultados OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 18069)
-- Name: resumenejecutivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resumenejecutivo (
    "Resumen" character varying(45) NOT NULL,
    "Entregable_idEntregable" integer NOT NULL,
    "Comentarios" character varying(500)
);


ALTER TABLE public.resumenejecutivo OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 18075)
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
-- TOC entry 241 (class 1259 OID 18081)
-- Name: tipoinvestigacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipoinvestigacion (
    id integer NOT NULL,
    descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tipoinvestigacion OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 18084)
-- Name: tiposector; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tiposector (
    id integer NOT NULL,
    descripcion character varying(45)
);


ALTER TABLE public.tiposector OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 18087)
-- Name: tipousuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipousuario (
    idtipousuario integer NOT NULL,
    descripciontipo character varying(30)
);


ALTER TABLE public.tipousuario OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 18090)
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
-- TOC entry 245 (class 1259 OID 18093)
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
-- TOC entry 2871 (class 2604 OID 18099)
-- Name: cambioAlumnos id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioAlumnos" ALTER COLUMN id_solicitud SET DEFAULT nextval('public."cambioAlumnos_id_solicitud_seq"'::regclass);


--
-- TOC entry 2873 (class 2604 OID 18100)
-- Name: cambioColaboradores id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioColaboradores" ALTER COLUMN id_solicitud SET DEFAULT nextval('public."cambioColaboradores2_id_solicitud_seq"'::regclass);


--
-- TOC entry 2874 (class 2604 OID 18101)
-- Name: carrera idCarrera; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carrera ALTER COLUMN "idCarrera" SET DEFAULT nextval('public."carrera_idCarrera_seq"'::regclass);


--
-- TOC entry 2875 (class 2604 OID 18102)
-- Name: cat_estadoproyecto idEstado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cat_estadoproyecto ALTER COLUMN "idEstado" SET DEFAULT nextval('public."estadoproyecto_idEstado_seq"'::regclass);


--
-- TOC entry 2876 (class 2604 OID 18103)
-- Name: catmetasalumno idMetas; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catmetasalumno ALTER COLUMN "idMetas" SET DEFAULT nextval('public."catmetasalumno_idMetas_seq"'::regclass);


--
-- TOC entry 2877 (class 2604 OID 18104)
-- Name: catsancion idCatSancion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catsancion ALTER COLUMN "idCatSancion" SET DEFAULT nextval('public."catsancion_idCatSancion_seq"'::regclass);


--
-- TOC entry 2878 (class 2604 OID 18105)
-- Name: entregable idEntregable; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entregable ALTER COLUMN "idEntregable" SET DEFAULT nextval('public."entregable_idEntregable_seq"'::regclass);


--
-- TOC entry 2879 (class 2604 OID 18106)
-- Name: metasalumnos idMetasAlumnos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metasalumnos ALTER COLUMN "idMetasAlumnos" SET DEFAULT nextval('public."metasalumnos_idMetasAlumnos_seq"'::regclass);


--
-- TOC entry 3109 (class 0 OID 17906)
-- Dependencies: 196
-- Data for Name: actividadesproyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3110 (class 0 OID 17912)
-- Dependencies: 197
-- Data for Name: alumno; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('117O4525', '9', 'FERNANDO', 'JUAN', 'LUNA', 3, 'DESARROLLAR EL PROTOTIPO FUNCIONAL', 'PRE3', true, true, false, 1, 'M');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('117O1234', '7', 'MARIA', 'GOMEZ', 'PALACIOS', 1, 'DORMIR', 'PRE3', true, false, true, 6, 'F');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('127O1254', '7', 'MARIO', 'GÓMEZ', 'FERNÁNDEZ', 1, 'OBTENER TODOS LOS REQUERIMIENTOS DEL SISTEMA', 'PRE3', true, false, false, 1, 'M');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('127O0949', '8', 'LENAE', 'PORTILLA', 'AHUMADA', 1, 'INVENTARIO DE LA TIENDITA', 'PRE4', true, true, false, 7, 'F');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('137O1419', '10', 'MIGUEL ANGEL', 'RIVAS', 'VIVEROS', 3, 'PROGRAMAR TODO EL SISTEMA', 'PRE3', true, true, true, 1, 'M');
INSERT INTO public.alumno ("NoControl", "Semestre", "Nombre", "Paterno", "Materno", id_carrera, "Actividades", "Folio_proyecto", servicio, residencia, tesis, estado, genero) VALUES ('127O2345', '9', 'JANETH', 'SANCHEZ', 'ORTIZ', 1, 'TRAER LAS TORTAS', 'PRE3', true, true, true, 7, 'F');


--
-- TOC entry 3111 (class 0 OID 17915)
-- Dependencies: 198
-- Data for Name: alumnoscolaboradoresdetalle; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (1, 'PRE3', '137O1419', B'1', B'1', B'1', 9, 'DISEÑAR INTERFACES');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (2, 'PRE3', '127O2345', B'1', B'1', B'1', 10, 'REALIZAR PRUEBAS');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (5, 'PRE3', '117O4525', B'1', B'1', B'0', 9, 'EXAMINAR CODIGO');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (6, 'PRE3', '127O1254', B'1', B'0', B'0', 10, 'ANALISIS DE REQUERIMIENTOS');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (4, 'PRE3', '117O1234', B'1', B'0', B'1', 10, 'HACER ALGO');
INSERT INTO public.alumnoscolaboradoresdetalle (pkdetalle_alumnocoldetalle, folioproyecto, "FkNoControl", servicio, residencia, tesis, semestre, actividades) VALUES (3, 'PRE4', '127O0949', B'1', B'0', B'0', 9, 'DISEÑAR LA BASE DE DATOS');


--
-- TOC entry 3112 (class 0 OID 17918)
-- Dependencies: 199
-- Data for Name: asesor; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3113 (class 0 OID 17921)
-- Dependencies: 200
-- Data for Name: cambioAlumnos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."cambioAlumnos" (id_solicitud, id_alum, folio_proyecto, id_tipo_cambio, motivo, nc_reemplazo, fecha_peticion, semestre, servic, resid, tesis, actividades_actuales, id_estado) VALUES (2, '127O0949', 'PRE4', 6, 'El cambio se realiza porque el alumno anterior tiene que salir del país', '127O2345', '2018-11-24', 7, B'0', B'0', B'0', 'DISEÑAR LA BASE DE DATOS', 12);
INSERT INTO public."cambioAlumnos" (id_solicitud, id_alum, folio_proyecto, id_tipo_cambio, motivo, nc_reemplazo, fecha_peticion, semestre, servic, resid, tesis, actividades_actuales, id_estado) VALUES (1, '117O1234', 'PRE4', 4, NULL, NULL, '2018-11-24', 7, B'0', B'0', B'0', 'REALIZAR DIAGRAMA DE CLASES', 12);


--
-- TOC entry 3115 (class 0 OID 17933)
-- Dependencies: 202
-- Data for Name: cambioColaboradores; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."cambioColaboradores" (id_solicitud, id_doc, folio_proyecto, id_tipo_cambio, motivo, np_reemplazo, fecha_peticion, actividades_actuales, id_estado) VALUES (1, 32, 'PRE4', 2, 'El docente anterior tuve que salir de viaje a Europa', 5, '2018-11-24', 'CHECAR EL CÓDIGO', 12);
INSERT INTO public."cambioColaboradores" (id_solicitud, id_doc, folio_proyecto, id_tipo_cambio, motivo, np_reemplazo, fecha_peticion, actividades_actuales, id_estado) VALUES (3, 8, 'PRE4', 1, NULL, NULL, '2018-11-24', 'REALIZAR DIAGRAMAS DE CLASE', 12);
INSERT INTO public."cambioColaboradores" (id_solicitud, id_doc, folio_proyecto, id_tipo_cambio, motivo, np_reemplazo, fecha_peticion, actividades_actuales, id_estado) VALUES (2, 1, 'PRE4', 3, 'Porque ya no trabaja', NULL, '2018-11-24', NULL, 15);


--
-- TOC entry 3117 (class 0 OID 17939)
-- Dependencies: 204
-- Data for Name: carrera; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.carrera ("idCarrera", "Descripcion") VALUES (2, 'INgenieria en gestion ');
INSERT INTO public.carrera ("idCarrera", "Descripcion") VALUES (3, 'ingenieria en sistemas');
INSERT INTO public.carrera ("idCarrera", "Descripcion") VALUES (1, 'Ingenieria bioquimica');


--
-- TOC entry 3119 (class 0 OID 17944)
-- Dependencies: 206
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
-- TOC entry 3159 (class 0 OID 18229)
-- Dependencies: 246
-- Data for Name: cat_sanciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3120 (class 0 OID 17947)
-- Dependencies: 207
-- Data for Name: cat_tipos_solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (1, 'Alta colaborador');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (2, 'Cambio colaborador');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (3, 'Baja colaborador');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (4, 'Alta alumno');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (5, 'Cambio alumno');
INSERT INTO public.cat_tipos_solicitudes (id, descripcion) VALUES (6, 'Baja alumno');


--
-- TOC entry 3121 (class 0 OID 17950)
-- Dependencies: 208
-- Data for Name: catmetasalumno; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3123 (class 0 OID 17955)
-- Dependencies: 210
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
-- TOC entry 3124 (class 0 OID 17958)
-- Dependencies: 211
-- Data for Name: catsancion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3126 (class 0 OID 17963)
-- Dependencies: 213
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
-- TOC entry 3127 (class 0 OID 17969)
-- Dependencies: 214
-- Data for Name: constancias; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3128 (class 0 OID 17972)
-- Dependencies: 215
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
-- TOC entry 3129 (class 0 OID 17975)
-- Dependencies: 216
-- Data for Name: entregable; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.entregable ("idEntregable", "FechaEntrega", "Observaciones", "Etapas_FolioProyecto", "Etapas_noEtapa", "Estatus", "FechaEntregada") VALUES (1, '2018-05-15', 'Entrega correcta', 'PRE4', 2, 1, '2018-11-30');


--
-- TOC entry 3132 (class 0 OID 17982)
-- Dependencies: 219
-- Data for Name: etapas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'PRIMERA', '2018-09-28', '2018-09-30', 3, 'AUN FALTA', 'ENTREGAR EN TIEMPO Y FORMA                                                    ', 'PROGRAMAR HASTA MORIR                              ', 'NO HAY                                                    ', 1);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'SEGUNDA', '2018-09-28', '2018-09-30', 2, 'YA FALTA MENOS', 'FECHA DE ENTREGA                                                    ', 'NO HAY POR EL MOMENTO                                                    ', 'PROTOTIPO                                                    ', 2);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'AGE ONE ', '2018-09-18', '2018-09-30', 2, 'EN ESTA ETAPA VAMOS A PENSAR EN LO QUE VAMOS A HACER', 'ENTREGAR EN TIEMPO Y FORMA', 'HACER LOS DIAGRAMAS DE CASOS DE USO                                   ', 'AÚN NO HAY ALGUNO                                          ', 3);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE3', 2, 'AGE TWO', '2018-09-18', '2018-10-31', 5, 'EN ESTA ETAPA YA VAMOS A ESTAR EN DESARROLLO', 'ENTREGAR UN PROTOTIPO                                                    ', 'PROGRAMAR TODO EL PROTOTIPO            ', 'PROTOTIPO FUNCIONAL', 4);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE4', 1, 'PRIMERA', '2018-09-28', '2018-09-30', 3, 'AUN FALTA', 'ENTREGAR EN TIEMPO Y FORMA', 'PROGRAMAR HASTA MORIR', 'NO HAY', 6);
INSERT INTO public.etapas ("FolioProyecto", "noEtapa", "NombreEtapa", "FechaInicio", "FechaFin", "Meses", "Descripcion", "Metas", "Actividades", "Productos", "PkEtapas") VALUES ('PRE4', 2, 'ENTREGA 1', '2018-10-31', '2019-03-31', 5, 'ENTREGA FINAL', 'DESARROLLAR UN SISTEMA                      ', 'HACER TODO   ', 'UN ERP PARA LA TIENDITA                               ', 5);


--
-- TOC entry 3133 (class 0 OID 17988)
-- Dependencies: 220
-- Data for Name: financiamientorequerido; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.financiamientorequerido ("FolioProyecto", "Financiamiento", "Interno", "Externo", "Especificar", "Infraestructura", "Consumibles", "Licencias", "Viaticos", "Publicaciones", "Equipo", "Patentes", "Otros", "Especifique") VALUES ('PRE3', false, NULL, NULL, NULL, 1.00, 2.00, 2.00, 3.00, 3.00, 3.00, 3.00, 3.00, 'OTRO MÁS');
INSERT INTO public.financiamientorequerido ("FolioProyecto", "Financiamiento", "Interno", "Externo", "Especificar", "Infraestructura", "Consumibles", "Licencias", "Viaticos", "Publicaciones", "Equipo", "Patentes", "Otros", "Especifique") VALUES ('PRE4', true, false, true, 'EL ITSX ME VA A PAGAR LOS CAMIONES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 3134 (class 0 OID 17991)
-- Dependencies: 221
-- Data for Name: lineainvestigacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.lineainvestigacion (id, descripcion) VALUES (1, 'Informactica');
INSERT INTO public.lineainvestigacion (id, descripcion) VALUES (2, 'Computo en la nube');


--
-- TOC entry 3135 (class 0 OID 17994)
-- Dependencies: 222
-- Data for Name: logrosconocimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3136 (class 0 OID 17997)
-- Dependencies: 223
-- Data for Name: logrosdivulgacionpublicaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3137 (class 0 OID 18003)
-- Dependencies: 224
-- Data for Name: logrospresentacioneseventos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3138 (class 0 OID 18006)
-- Dependencies: 225
-- Data for Name: logrosrecursoshumanos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3139 (class 0 OID 18009)
-- Dependencies: 226
-- Data for Name: metas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.metas ("FkFolioProyecto", "Servicio", "Residencia", "Tesis", "Ponencia", "Articulos", "Libros", "PropiedadesIntelectual", "Otros", "PkMetas") VALUES ('PRE4', true, true, false, false, false, false, '', '', 2);
INSERT INTO public.metas ("FkFolioProyecto", "Servicio", "Residencia", "Tesis", "Ponencia", "Articulos", "Libros", "PropiedadesIntelectual", "Otros", "PkMetas") VALUES ('PRE3', true, true, true, false, false, false, 'INTELIGENTE', '', 1);


--
-- TOC entry 3140 (class 0 OID 18015)
-- Dependencies: 227
-- Data for Name: metasalcanzadas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3141 (class 0 OID 18021)
-- Dependencies: 228
-- Data for Name: metasalumnos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3143 (class 0 OID 18026)
-- Dependencies: 230
-- Data for Name: notificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3144 (class 0 OID 18030)
-- Dependencies: 231
-- Data for Name: objetivosalcanzados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3145 (class 0 OID 18036)
-- Dependencies: 232
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
-- TOC entry 3146 (class 0 OID 18042)
-- Dependencies: 233
-- Data for Name: observacionesentregable; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3147 (class 0 OID 18048)
-- Dependencies: 234
-- Data for Name: prorroga; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.prorroga ("Motivo", tiempo, "ObsGestion", "ObsInv", "ObsCom", "Proyecto_FolioProyecto", "Razones", fecha_solicitud, id_docente, otro_especifique, etapa_solicitada) VALUES ('Otro', NULL, NULL, NULL, NULL, 'PRE4', 'Tengo gripe crónica', '2018-10-07', 1, 'Me duele la cabeza', 2);


--
-- TOC entry 3148 (class 0 OID 18054)
-- Dependencies: 235
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar", "NoRevision") VALUES ('PRE1', NULL, '2018-09-06', NULL, NULL, NULL, NULL, NULL, NULL, 'CPR1', 1, 1, 1, '2018-09-06', '2019-03-06', 'apremat', NULL, NULL, NULL, '', 1);
INSERT INTO public.proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar", "NoRevision") VALUES ('PRE4', 1, '2018-09-19', NULL, 'PUNTO', 'VENTA', 'ERP', 2, 'ANALIZAR, DISEÑAR Y PROGRAMAR', 'CPR1', 1, 2, 1, '2018-10-01', '2019-03-31', 'ERP TIENDITA', 'ANALIZAR, DISEÑAR, PROGRAMAR Y PROBAR', 'UN ERP PARA LA TIENDITA', 'UN ERP PARA UN PUNTO DE VENTA', '', 1);
INSERT INTO public.proyecto ("FolioProyecto", "idEstado", "FechaPresentacion", "FechaReactivacion", "PalabraClave1", "PalabraClave2", "PalabraClave3", "Responsable", "actividadesResponsable", "ConvocatoriaCPR", "TipoInvestigacion", "TipoSector", "LineaInvestigacion", "Inicio", "Fin", "NombreProyecto", "ObjetivoGeneral", "ObjetivoEspecifico", "Resultados", "Especificar", "NoRevision") VALUES ('PRE3', 2, '2018-09-06', NULL, 'programa', 'inteligencia', 'artificial', 1, 'diseñar interfaces', 'CPR1', 1, 1, 1, '2018-09-06', '2019-03-06', 'sigue', 'CONTRUIR ALGO', 'ANALIZAR
DISEÑAR
PROGRAMAR', 'UN SISTEMA EFICIENTE', '', 1);


--
-- TOC entry 3149 (class 0 OID 18060)
-- Dependencies: 236
-- Data for Name: proyectoscancelados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3150 (class 0 OID 18063)
-- Dependencies: 237
-- Data for Name: recepcion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3151 (class 0 OID 18066)
-- Dependencies: 238
-- Data for Name: resultados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3152 (class 0 OID 18069)
-- Dependencies: 239
-- Data for Name: resumenejecutivo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3153 (class 0 OID 18075)
-- Dependencies: 240
-- Data for Name: sanciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3154 (class 0 OID 18081)
-- Dependencies: 241
-- Data for Name: tipoinvestigacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tipoinvestigacion (id, descripcion) VALUES (1, 'investigacion Aplicada');
INSERT INTO public.tipoinvestigacion (id, descripcion) VALUES (2, 'Investigacion Pura');
INSERT INTO public.tipoinvestigacion (id, descripcion) VALUES (3, 'Investigacion especial');


--
-- TOC entry 3155 (class 0 OID 18084)
-- Dependencies: 242
-- Data for Name: tiposector; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tiposector (id, descripcion) VALUES (1, 'Publico');
INSERT INTO public.tiposector (id, descripcion) VALUES (2, 'Privado');


--
-- TOC entry 3156 (class 0 OID 18087)
-- Dependencies: 243
-- Data for Name: tipousuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (1, 'Docente');
INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (2, 'Gestion');
INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (3, 'Investigacion');
INSERT INTO public.tipousuario (idtipousuario, descripciontipo) VALUES (4, 'Comite');


--
-- TOC entry 3157 (class 0 OID 18090)
-- Dependencies: 244
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
-- TOC entry 3158 (class 0 OID 18093)
-- Dependencies: 245
-- Data for Name: vinculacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.vinculacion ("FolioProyecto", "NombreOrganizacion", "Dirección", "Area", "Telefono", "NombreCompleto", "DescripcionOrganizacion", "DescripcionAportaciones") VALUES ('PRE3', 'CHEDRAUI', 'CERCA', 'GRANDE', '2255888445', 'VELAZQUEZ', 'TIENDITA DE LA ESQUINA', 'ME DEPOSITAN CADA MES');
INSERT INTO public.vinculacion ("FolioProyecto", "NombreOrganizacion", "Dirección", "Area", "Telefono", "NombreCompleto", "DescripcionOrganizacion", "DescripcionAportaciones") VALUES ('PRE4', 'GOBIERNO DEL ESTADO', 'ENRIQUE SEGOVIANO', 'INFORMÁTICA', '123456', 'PEDRO DAMIÁN LÓPEZ', 'ES UNA INSTITUCIÓN GUBERNAMENTAL', '');


--
-- TOC entry 3177 (class 0 OID 0)
-- Dependencies: 201
-- Name: cambioAlumnos_id_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."cambioAlumnos_id_solicitud_seq"', 2, true);


--
-- TOC entry 3178 (class 0 OID 0)
-- Dependencies: 203
-- Name: cambioColaboradores2_id_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."cambioColaboradores2_id_solicitud_seq"', 3, true);


--
-- TOC entry 3179 (class 0 OID 0)
-- Dependencies: 205
-- Name: carrera_idCarrera_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."carrera_idCarrera_seq"', 1, false);


--
-- TOC entry 3180 (class 0 OID 0)
-- Dependencies: 209
-- Name: catmetasalumno_idMetas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."catmetasalumno_idMetas_seq"', 1, false);


--
-- TOC entry 3181 (class 0 OID 0)
-- Dependencies: 212
-- Name: catsancion_idCatSancion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."catsancion_idCatSancion_seq"', 1, false);


--
-- TOC entry 3182 (class 0 OID 0)
-- Dependencies: 217
-- Name: entregable_idEntregable_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."entregable_idEntregable_seq"', 1, false);


--
-- TOC entry 3183 (class 0 OID 0)
-- Dependencies: 218
-- Name: estadoproyecto_idEstado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."estadoproyecto_idEstado_seq"', 1, false);


--
-- TOC entry 3184 (class 0 OID 0)
-- Dependencies: 229
-- Name: metasalumnos_idMetasAlumnos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."metasalumnos_idMetasAlumnos_seq"', 1, false);


--
-- TOC entry 2882 (class 2606 OID 18108)
-- Name: actividadesproyecto actividadesproyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actividadesproyecto
    ADD CONSTRAINT "actividadesproyecto_PRIMARY" PRIMARY KEY ("InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2885 (class 2606 OID 18110)
-- Name: alumno alumno_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno
    ADD CONSTRAINT "alumno_PRIMARY" PRIMARY KEY ("NoControl");


--
-- TOC entry 2890 (class 2606 OID 18112)
-- Name: asesor asesor_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asesor
    ADD CONSTRAINT "asesor_PRIMARY" PRIMARY KEY ("IdUsuario");


--
-- TOC entry 2892 (class 2606 OID 18114)
-- Name: cambioAlumnos cambioAlumnos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioAlumnos"
    ADD CONSTRAINT "cambioAlumnos_pkey" PRIMARY KEY (id_solicitud);


--
-- TOC entry 2894 (class 2606 OID 18116)
-- Name: cambioColaboradores cambioColaboradores2_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."cambioColaboradores"
    ADD CONSTRAINT "cambioColaboradores2_pkey" PRIMARY KEY (id_solicitud);


--
-- TOC entry 2896 (class 2606 OID 18118)
-- Name: carrera carrera_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carrera
    ADD CONSTRAINT "carrera_PRIMARY" PRIMARY KEY ("idCarrera");


--
-- TOC entry 2982 (class 2606 OID 18233)
-- Name: cat_sanciones cat_sanciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cat_sanciones
    ADD CONSTRAINT cat_sanciones_pkey PRIMARY KEY (id_sancion);


--
-- TOC entry 2900 (class 2606 OID 18120)
-- Name: cat_tipos_solicitudes cat_tipos_solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cat_tipos_solicitudes
    ADD CONSTRAINT cat_tipos_solicitudes_pkey PRIMARY KEY (id);


--
-- TOC entry 2902 (class 2606 OID 18122)
-- Name: catmetasalumno catmetasalumno_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catmetasalumno
    ADD CONSTRAINT "catmetasalumno_PRIMARY" PRIMARY KEY ("idMetas");


--
-- TOC entry 2904 (class 2606 OID 18124)
-- Name: catobservaciones catobservcaciones_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catobservaciones
    ADD CONSTRAINT "catobservcaciones_PRIMARY" PRIMARY KEY ("idObservaciones");


--
-- TOC entry 2906 (class 2606 OID 18126)
-- Name: catsancion catsancion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.catsancion
    ADD CONSTRAINT "catsancion_PRIMARY" PRIMARY KEY ("idCatSancion");


--
-- TOC entry 2908 (class 2606 OID 18128)
-- Name: colaboradordocente colaboradordocente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colaboradordocente
    ADD CONSTRAINT colaboradordocente_pkey PRIMARY KEY ("Docente_noPersonal");


--
-- TOC entry 2913 (class 2606 OID 18130)
-- Name: docente docente_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.docente
    ADD CONSTRAINT "docente_PRIMARY" PRIMARY KEY ("noPersonal");


--
-- TOC entry 2916 (class 2606 OID 18132)
-- Name: entregable entregable_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entregable
    ADD CONSTRAINT "entregable_PRIMARY" PRIMARY KEY ("idEntregable", "Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2898 (class 2606 OID 18134)
-- Name: cat_estadoproyecto estadoproyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cat_estadoproyecto
    ADD CONSTRAINT "estadoproyecto_PRIMARY" PRIMARY KEY ("idEstado");


--
-- TOC entry 2922 (class 2606 OID 18136)
-- Name: financiamientorequerido financiamientorequerido_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.financiamientorequerido
    ADD CONSTRAINT "financiamientorequerido_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2976 (class 2606 OID 18138)
-- Name: tipousuario id_tipo_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipousuario
    ADD CONSTRAINT id_tipo_usuario PRIMARY KEY (idtipousuario);


--
-- TOC entry 2924 (class 2606 OID 18140)
-- Name: lineainvestigacion lineainvestigacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lineainvestigacion
    ADD CONSTRAINT "lineainvestigacion_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2926 (class 2606 OID 18142)
-- Name: logrosconocimiento logrosconocimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.logrosconocimiento
    ADD CONSTRAINT logrosconocimiento_pkey PRIMARY KEY ("Entregable_idEntregable");


--
-- TOC entry 2931 (class 2606 OID 18144)
-- Name: metas metas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metas
    ADD CONSTRAINT metas_pkey PRIMARY KEY ("PkMetas");


--
-- TOC entry 2934 (class 2606 OID 18146)
-- Name: metasalcanzadas metasalcanzadas_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metasalcanzadas
    ADD CONSTRAINT "metasalcanzadas_PRIMARY" PRIMARY KEY ("InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2939 (class 2606 OID 18148)
-- Name: metasalumnos metasalumnos_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metasalumnos
    ADD CONSTRAINT "metasalumnos_PRIMARY" PRIMARY KEY ("idMetasAlumnos");


--
-- TOC entry 2943 (class 2606 OID 18150)
-- Name: notificaciones notificaciones_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificaciones
    ADD CONSTRAINT "notificaciones_PRIMARY" PRIMARY KEY ("IdNotificacion");


--
-- TOC entry 2946 (class 2606 OID 18152)
-- Name: objetivosalcanzados objetivosalcanzados_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.objetivosalcanzados
    ADD CONSTRAINT "objetivosalcanzados_PRIMARY" PRIMARY KEY ("No.Objetivos", "InformeGeneral_IdInformeGeneral");


--
-- TOC entry 2950 (class 2606 OID 18154)
-- Name: observacionesentregable observacionesentregable_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.observacionesentregable
    ADD CONSTRAINT "observacionesentregable_PRIMARY" PRIMARY KEY ("Entregable_idEntregable");


--
-- TOC entry 2888 (class 2606 OID 18156)
-- Name: alumnoscolaboradoresdetalle pk_alumno_col_detalle; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnoscolaboradoresdetalle
    ADD CONSTRAINT pk_alumno_col_detalle PRIMARY KEY (pkdetalle_alumnocoldetalle);


--
-- TOC entry 2920 (class 2606 OID 18158)
-- Name: etapas pk_etapas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas
    ADD CONSTRAINT pk_etapas PRIMARY KEY ("PkEtapas");


--
-- TOC entry 2953 (class 2606 OID 18228)
-- Name: prorroga prorroga_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prorroga
    ADD CONSTRAINT prorroga_pkey PRIMARY KEY ("Proyecto_FolioProyecto", fecha_solicitud, id_docente);


--
-- TOC entry 2960 (class 2606 OID 18160)
-- Name: proyecto proyecto_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyecto
    ADD CONSTRAINT "proyecto_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2962 (class 2606 OID 18162)
-- Name: proyectoscancelados proyectoscancelados_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proyectoscancelados
    ADD CONSTRAINT "proyectoscancelados_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2965 (class 2606 OID 18164)
-- Name: recepcion recepcion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recepcion
    ADD CONSTRAINT "recepcion_PRIMARY" PRIMARY KEY ("No.Solicitud", "Proyecto_FolioProyecto");


--
-- TOC entry 2972 (class 2606 OID 18166)
-- Name: tipoinvestigacion tipoinvestigacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipoinvestigacion
    ADD CONSTRAINT "tipoinvestigacion_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2974 (class 2606 OID 18168)
-- Name: tiposector tiposector_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tiposector
    ADD CONSTRAINT "tiposector_PRIMARY" PRIMARY KEY (id);


--
-- TOC entry 2978 (class 2606 OID 18170)
-- Name: usuario usuario_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT "usuario_PRIMARY" PRIMARY KEY ("NoPersonal");


--
-- TOC entry 2980 (class 2606 OID 18172)
-- Name: vinculacion vinculacion_PRIMARY; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vinculacion
    ADD CONSTRAINT "vinculacion_PRIMARY" PRIMARY KEY ("FolioProyecto");


--
-- TOC entry 2940 (class 1259 OID 18173)
-- Name: Emi_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "Emi_idx" ON public.notificaciones USING btree ("Emisor");


--
-- TOC entry 2941 (class 1259 OID 18174)
-- Name: Rece_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "Rece_idx" ON public.notificaciones USING btree ("Receptor");


--
-- TOC entry 2883 (class 1259 OID 18175)
-- Name: fk_ActividadesProyecto_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ActividadesProyecto_Entregable1_idx" ON public.actividadesproyecto USING btree ("Entregable_idEntregable");


--
-- TOC entry 2886 (class 1259 OID 18176)
-- Name: fk_Alumno_Carrera1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Alumno_Carrera1_idx" ON public.alumno USING btree (id_carrera);


--
-- TOC entry 2909 (class 1259 OID 18177)
-- Name: fk_ColaboradorDocente_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ColaboradorDocente_Docente1_idx" ON public.colaboradordocente USING btree ("Docente_noPersonal");


--
-- TOC entry 2910 (class 1259 OID 18178)
-- Name: fk_ColaboradorDocente_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ColaboradorDocente_Proyecto1_idx" ON public.colaboradordocente USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2911 (class 1259 OID 18179)
-- Name: fk_Constancias_Etapas1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Constancias_Etapas1_idx" ON public.constancias USING btree ("Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2914 (class 1259 OID 18180)
-- Name: fk_Docente_Carrera1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Docente_Carrera1_idx" ON public.docente USING btree ("Carrera_idCarrera");


--
-- TOC entry 2917 (class 1259 OID 18181)
-- Name: fk_Entregable_Etapas1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Entregable_Etapas1_idx" ON public.entregable USING btree ("Etapas_FolioProyecto", "Etapas_noEtapa");


--
-- TOC entry 2918 (class 1259 OID 18182)
-- Name: fk_Etapas_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Etapas_Proyecto1_idx" ON public.etapas USING btree ("FolioProyecto");


--
-- TOC entry 2927 (class 1259 OID 18183)
-- Name: fk_LogrosDivulgacionPublicaciones_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosDivulgacionPublicaciones_Entregable1_idx" ON public.logrosdivulgacionpublicaciones USING btree ("Entregable_idEntregable");


--
-- TOC entry 2928 (class 1259 OID 18184)
-- Name: fk_LogrosPresentacionesEventos_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosPresentacionesEventos_Entregable1_idx" ON public.logrospresentacioneseventos USING btree ("Entregable_idEntregable");


--
-- TOC entry 2929 (class 1259 OID 18185)
-- Name: fk_LogrosRecursosHumanos_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_LogrosRecursosHumanos_Entregable1_idx" ON public.logrosrecursoshumanos USING btree ("Entregable_idEntregable");


--
-- TOC entry 2932 (class 1259 OID 18186)
-- Name: fk_MetasAlcanzadas_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlcanzadas_Entregable1_idx" ON public.metasalcanzadas USING btree ("Entregable_idEntregable");


--
-- TOC entry 2935 (class 1259 OID 18187)
-- Name: fk_MetasAlumnos_Alumno1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_Alumno1_idx" ON public.metasalumnos USING btree ("Alumno_NoControl");


--
-- TOC entry 2936 (class 1259 OID 18188)
-- Name: fk_MetasAlumnos_CatMetasAlumno1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_CatMetasAlumno1_idx" ON public.metasalumnos USING btree ("CatMetasAlumno_idMetas");


--
-- TOC entry 2937 (class 1259 OID 18189)
-- Name: fk_MetasAlumnos_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_MetasAlumnos_Proyecto1_idx" ON public.metasalumnos USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2944 (class 1259 OID 18190)
-- Name: fk_ObjetivosAlcanzados_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ObjetivosAlcanzados_Entregable1_idx" ON public.objetivosalcanzados USING btree ("Entregable_idEntregable");


--
-- TOC entry 2947 (class 1259 OID 18191)
-- Name: fk_ObservacionesEntregable_CatObservcaciones1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ObservacionesEntregable_CatObservcaciones1_idx" ON public.observacionesentregable USING btree ("CatObservcaciones_idObservaciones");


--
-- TOC entry 2948 (class 1259 OID 18192)
-- Name: fk_Observaciones_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Observaciones_Entregable1_idx" ON public.observacionesentregable USING btree ("Entregable_idEntregable");


--
-- TOC entry 2951 (class 1259 OID 18193)
-- Name: fk_Prorroga_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Prorroga_Proyecto1_idx" ON public.prorroga USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2954 (class 1259 OID 18194)
-- Name: fk_Proyecto_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Proyecto_Docente1_idx" ON public.proyecto USING btree ("Responsable");


--
-- TOC entry 2955 (class 1259 OID 18195)
-- Name: fk_Proyecto_EstadoProyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Proyecto_EstadoProyecto1_idx" ON public.proyecto USING btree ("idEstado");


--
-- TOC entry 2963 (class 1259 OID 18196)
-- Name: fk_Recepcion_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Recepcion_Proyecto1_idx" ON public.recepcion USING btree ("Proyecto_FolioProyecto");


--
-- TOC entry 2966 (class 1259 OID 18197)
-- Name: fk_Resultados_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Resultados_Entregable1_idx" ON public.resultados USING btree ("Entregable_idEntregable");


--
-- TOC entry 2967 (class 1259 OID 18198)
-- Name: fk_ResumenEjecutivo_Entregable1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_ResumenEjecutivo_Entregable1_idx" ON public.resumenejecutivo USING btree ("Entregable_idEntregable");


--
-- TOC entry 2968 (class 1259 OID 18199)
-- Name: fk_Sanciones_CatSancion1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_CatSancion1_idx" ON public.sanciones USING btree ("idCatSancion");


--
-- TOC entry 2969 (class 1259 OID 18200)
-- Name: fk_Sanciones_Docente1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_Docente1_idx" ON public.sanciones USING btree ("no.personal");


--
-- TOC entry 2970 (class 1259 OID 18201)
-- Name: fk_Sanciones_Proyecto1_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "fk_Sanciones_Proyecto1_idx" ON public.sanciones USING btree ("FolioProyecto");


--
-- TOC entry 2956 (class 1259 OID 18202)
-- Name: fk_linea_investigacion_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_linea_investigacion_idx ON public.proyecto USING btree ("LineaInvestigacion");


--
-- TOC entry 2957 (class 1259 OID 18203)
-- Name: fk_tipo_investigacion_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_tipo_investigacion_idx ON public.proyecto USING btree ("TipoInvestigacion");


--
-- TOC entry 2958 (class 1259 OID 18204)
-- Name: fk_tipo_sector_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fk_tipo_sector_idx ON public.proyecto USING btree ("TipoSector");


--
-- TOC entry 2985 (class 2606 OID 18205)
-- Name: etapas fk_folio_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas
    ADD CONSTRAINT fk_folio_proyecto FOREIGN KEY ("FolioProyecto") REFERENCES public.proyecto("FolioProyecto");


--
-- TOC entry 2983 (class 2606 OID 18210)
-- Name: alumnoscolaboradoresdetalle fk_folio_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnoscolaboradoresdetalle
    ADD CONSTRAINT fk_folio_proyecto FOREIGN KEY (folioproyecto) REFERENCES public.proyecto("FolioProyecto");


--
-- TOC entry 2986 (class 2606 OID 18215)
-- Name: metas fk_folio_proyectos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metas
    ADD CONSTRAINT fk_folio_proyectos FOREIGN KEY ("FkFolioProyecto") REFERENCES public.proyecto("FolioProyecto");


--
-- TOC entry 2984 (class 2606 OID 18220)
-- Name: alumnoscolaboradoresdetalle fk_no_control_alumno; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnoscolaboradoresdetalle
    ADD CONSTRAINT fk_no_control_alumno FOREIGN KEY ("FkNoControl") REFERENCES public.alumno("NoControl");


--
-- TOC entry 2987 (class 2606 OID 18234)
-- Name: sanciones sanciones_catalago; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sanciones
    ADD CONSTRAINT sanciones_catalago FOREIGN KEY ("idCatSancion") REFERENCES public.cat_sanciones(id_sancion);


-- Completed on 2018-11-30 20:14:54

--
-- PostgreSQL database dump complete
--

