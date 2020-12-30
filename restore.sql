--
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE javalato;
--
-- Name: javalato; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE javalato WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.1252';


ALTER DATABASE javalato OWNER TO postgres;

\connect javalato

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: servico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.servico (
    nome character(50) NOT NULL,
    descricao character(100),
    id_servico integer NOT NULL,
    preco integer NOT NULL
);


ALTER TABLE public.servico OWNER TO postgres;

--
-- Name: Servico_ID_servico_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Servico_ID_servico_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Servico_ID_servico_seq" OWNER TO postgres;

--
-- Name: Servico_ID_servico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Servico_ID_servico_seq" OWNED BY public.servico.id_servico;


--
-- Name: carro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.carro (
    placa character(7) NOT NULL,
    modelo character(20) NOT NULL,
    ano integer NOT NULL,
    cpf character(14) NOT NULL
);


ALTER TABLE public.carro OWNER TO postgres;

--
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cliente (
    nome character(80) NOT NULL,
    cpf character(14) NOT NULL,
    telefone character(14)
);


ALTER TABLE public.cliente OWNER TO postgres;

--
-- Name: funcionario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.funcionario (
    nome character(255) NOT NULL,
    cpf character(14) NOT NULL,
    telefone character(12) NOT NULL,
    id_funcionario integer NOT NULL
);


ALTER TABLE public.funcionario OWNER TO postgres;

--
-- Name: item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.item (
    id_item integer NOT NULL,
    id_pedido integer NOT NULL,
    id_servico integer NOT NULL,
    quantidade integer NOT NULL
);


ALTER TABLE public.item OWNER TO postgres;

--
-- Name: item_id_item_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.item_id_item_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.item_id_item_seq OWNER TO postgres;

--
-- Name: item_id_item_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.item_id_item_seq OWNED BY public.item.id_item;


--
-- Name: item_id_pedido_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.item_id_pedido_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.item_id_pedido_seq OWNER TO postgres;

--
-- Name: item_id_pedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.item_id_pedido_seq OWNED BY public.item.id_pedido;


--
-- Name: item_id_servico_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.item_id_servico_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.item_id_servico_seq OWNER TO postgres;

--
-- Name: item_id_servico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.item_id_servico_seq OWNED BY public.item.id_servico;


--
-- Name: pedido; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pedido (
    numero integer NOT NULL,
    id_pedido integer NOT NULL,
    cpf_cliente character(14) NOT NULL,
    id_funcionario integer NOT NULL,
    order_date date NOT NULL,
    preco_total money NOT NULL
);


ALTER TABLE public.pedido OWNER TO postgres;

--
-- Name: pedido_id_funcionario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pedido_id_funcionario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pedido_id_funcionario_seq OWNER TO postgres;

--
-- Name: pedido_id_funcionario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pedido_id_funcionario_seq OWNED BY public.pedido.id_funcionario;


--
-- Name: pedido_id_pedido_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pedido_id_pedido_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pedido_id_pedido_seq OWNER TO postgres;

--
-- Name: pedido_id_pedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pedido_id_pedido_seq OWNED BY public.pedido.id_pedido;


--
-- Name: item id_item; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item ALTER COLUMN id_item SET DEFAULT nextval('public.item_id_item_seq'::regclass);


--
-- Name: item id_pedido; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item ALTER COLUMN id_pedido SET DEFAULT nextval('public.item_id_pedido_seq'::regclass);


--
-- Name: item id_servico; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item ALTER COLUMN id_servico SET DEFAULT nextval('public.item_id_servico_seq'::regclass);


--
-- Name: pedido id_pedido; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido ALTER COLUMN id_pedido SET DEFAULT nextval('public.pedido_id_pedido_seq'::regclass);


--
-- Name: pedido id_funcionario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido ALTER COLUMN id_funcionario SET DEFAULT nextval('public.pedido_id_funcionario_seq'::regclass);


--
-- Name: servico id_servico; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servico ALTER COLUMN id_servico SET DEFAULT nextval('public."Servico_ID_servico_seq"'::regclass);


--
-- Data for Name: carro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.carro (placa, modelo, ano, cpf) FROM stdin;
\.
COPY public.carro (placa, modelo, ano, cpf) FROM '$$PATH$$/3044.dat';

--
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (nome, cpf, telefone) FROM stdin;
\.
COPY public.cliente (nome, cpf, telefone) FROM '$$PATH$$/3035.dat';

--
-- Data for Name: funcionario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.funcionario (nome, cpf, telefone, id_funcionario) FROM stdin;
\.
COPY public.funcionario (nome, cpf, telefone, id_funcionario) FROM '$$PATH$$/3036.dat';

--
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.item (id_item, id_pedido, id_servico, quantidade) FROM stdin;
\.
COPY public.item (id_item, id_pedido, id_servico, quantidade) FROM '$$PATH$$/3043.dat';

--
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pedido (numero, id_pedido, cpf_cliente, id_funcionario, order_date, preco_total) FROM stdin;
\.
COPY public.pedido (numero, id_pedido, cpf_cliente, id_funcionario, order_date, preco_total) FROM '$$PATH$$/3039.dat';

--
-- Data for Name: servico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servico (nome, descricao, id_servico, preco) FROM stdin;
\.
COPY public.servico (nome, descricao, id_servico, preco) FROM '$$PATH$$/3034.dat';

--
-- Name: Servico_ID_servico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Servico_ID_servico_seq"', 7, true);


--
-- Name: item_id_item_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_item_seq', 37, true);


--
-- Name: item_id_pedido_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_pedido_seq', 27, true);


--
-- Name: item_id_servico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_servico_seq', 1, false);


--
-- Name: pedido_id_funcionario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pedido_id_funcionario_seq', 1, false);


--
-- Name: pedido_id_pedido_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pedido_id_pedido_seq', 21, true);


--
-- Name: cliente Client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT "Client_pkey" PRIMARY KEY (cpf);


--
-- Name: funcionario Funcionario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT "Funcionario_pkey" PRIMARY KEY (id_funcionario);


--
-- Name: servico Servico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servico
    ADD CONSTRAINT "Servico_pkey" PRIMARY KEY (id_servico);


--
-- Name: carro carro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carro
    ADD CONSTRAINT carro_pkey PRIMARY KEY (placa);


--
-- Name: item item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_pkey PRIMARY KEY (id_item);


--
-- Name: pedido pedido_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_pkey PRIMARY KEY (id_pedido);


--
-- Name: carro carro_cpf_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carro
    ADD CONSTRAINT carro_cpf_fkey FOREIGN KEY (cpf) REFERENCES public.cliente(cpf);


--
-- Name: item item_id_pedido_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_id_pedido_fkey FOREIGN KEY (id_pedido) REFERENCES public.pedido(id_pedido);


--
-- Name: item item_id_servico_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_id_servico_fkey FOREIGN KEY (id_servico) REFERENCES public.servico(id_servico);


--
-- Name: pedido pedido_cpf_cliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_cpf_cliente_fkey FOREIGN KEY (cpf_cliente) REFERENCES public.cliente(cpf);


--
-- Name: pedido pedido_id_funcionario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_id_funcionario_fkey FOREIGN KEY (id_funcionario) REFERENCES public.funcionario(id_funcionario);


--
-- PostgreSQL database dump complete
--

