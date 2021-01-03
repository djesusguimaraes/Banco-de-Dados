--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

-- Started on 2021-01-02 23:00:05

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
-- TOC entry 201 (class 1259 OID 16705)
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
-- TOC entry 200 (class 1259 OID 16703)
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
-- TOC entry 3037 (class 0 OID 0)
-- Dependencies: 200
-- Name: Servico_ID_servico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Servico_ID_servico_seq" OWNED BY public.servico.id_servico;


--
-- TOC entry 206 (class 1259 OID 16885)
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
-- TOC entry 202 (class 1259 OID 16798)
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cliente (
    nome character(80) NOT NULL,
    cpf character(14) NOT NULL,
    telefone character(14),
    delete_at date
);


ALTER TABLE public.cliente OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16819)
-- Name: funcionario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.funcionario (
    nome character(80) NOT NULL,
    cpf character(14) NOT NULL,
    telefone character(14) NOT NULL,
    id_funcionario integer NOT NULL
);


ALTER TABLE public.funcionario OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 33121)
-- Name: item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.item (
    id_item integer NOT NULL,
    quantidade integer NOT NULL,
    id_pedido integer NOT NULL,
    id_servico integer NOT NULL
);


ALTER TABLE public.item OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 33119)
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
-- TOC entry 3038 (class 0 OID 0)
-- Dependencies: 207
-- Name: item_id_item_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.item_id_item_seq OWNED BY public.item.id_item;


--
-- TOC entry 205 (class 1259 OID 16844)
-- Name: pedido; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pedido (
    id_pedido integer NOT NULL,
    cpf_cliente character(14) NOT NULL,
    order_date date NOT NULL,
    preco_total money NOT NULL,
    id_funcionario integer NOT NULL
);


ALTER TABLE public.pedido OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16840)
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
-- TOC entry 3039 (class 0 OID 0)
-- Dependencies: 204
-- Name: pedido_id_pedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pedido_id_pedido_seq OWNED BY public.pedido.id_pedido;


--
-- TOC entry 2876 (class 2604 OID 33124)
-- Name: item id_item; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item ALTER COLUMN id_item SET DEFAULT nextval('public.item_id_item_seq'::regclass);


--
-- TOC entry 2875 (class 2604 OID 16847)
-- Name: pedido id_pedido; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido ALTER COLUMN id_pedido SET DEFAULT nextval('public.pedido_id_pedido_seq'::regclass);


--
-- TOC entry 2874 (class 2604 OID 16708)
-- Name: servico id_servico; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servico ALTER COLUMN id_servico SET DEFAULT nextval('public."Servico_ID_servico_seq"'::regclass);


--
-- TOC entry 3029 (class 0 OID 16885)
-- Dependencies: 206
-- Data for Name: carro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.carro (placa, modelo, ano, cpf) FROM stdin;
FJS8340	Fusca               	1980	734.304.803-24
\.


--
-- TOC entry 3025 (class 0 OID 16798)
-- Dependencies: 202
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (nome, cpf, telefone, delete_at) FROM stdin;
Jão da Padaria                                                                  	734.304.803-24	0843048-3049  	\N
\.


--
-- TOC entry 3026 (class 0 OID 16819)
-- Dependencies: 203
-- Data for Name: funcionario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.funcionario (nome, cpf, telefone, id_funcionario) FROM stdin;
Brandt                                                                          	444.444.444-44	7799937-6311  	7799
Thays                                                                           	555.555.555-55	6399237-9162  	9821
Davizão                                                                         	222.222.222-22	6398506-4555  	1112
Nérso                                                                           	323.323.434-00	4324112-3421  	101
Heitor Silva                                                                    	923.759.374-93	4873295-2732  	4739
\.


--
-- TOC entry 3031 (class 0 OID 33121)
-- Dependencies: 208
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.item (id_item, quantidade, id_pedido, id_servico) FROM stdin;
\.


--
-- TOC entry 3028 (class 0 OID 16844)
-- Dependencies: 205
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pedido (id_pedido, cpf_cliente, order_date, preco_total, id_funcionario) FROM stdin;
\.


--
-- TOC entry 3024 (class 0 OID 16705)
-- Dependencies: 201
-- Data for Name: servico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servico (nome, descricao, id_servico, preco) FROM stdin;
Ducha Simples                                     	Limpeza externa básica                                                                              	9	20
Aplicação de cera                                 	Tratamento com cera para a lataria                                                                  	10	50
Higienização e Hidratação em Bancos               	Tratamento para couros e estofados automotivos                                                      	11	80
Higienização de Ar Condicinado                    	Limpeza e troca de filtros de ar automotivo                                                         	12	140
Higienização de Teto                              	Tratamento químico detalhado para deixar seu teto novo                                              	13	160
Hipermeabilização de Tecido                       	Máscaras siliconadas para tecidos e troca carpetes                                                  	14	200
Lavagem Técnica do Motor                          	Lavagem detalhada dos componentes do motor                                                          	15	300
Descontaminação de Pintura                        	Remoção de quaisquer impurezas da pintura e rodas                                                   	16	150
Vitrificação de Pintura                           	Proteção vitrificada para sua pintura                                                               	17	200
Insul Film                                        	Aplicação de películas de proteção para janelas e para-brisas                                       	18	250
Tira Riscos                                       	Tira Riscos                                                                                         	19	300
Polimento Técnico                                 	Polimento cristalizado especializado                                                                	20	350
Lavagem Ecológica                                 	Usa apenas 500ml de água                                                                            	21	100
Ducha Completa                                    	Lavagem externa detalhada.                                                                          	6	40
Limpeza Completa                                  	Limpeza interna e externa                                                                           	7	60
\.


--
-- TOC entry 3040 (class 0 OID 0)
-- Dependencies: 200
-- Name: Servico_ID_servico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Servico_ID_servico_seq"', 21, true);


--
-- TOC entry 3041 (class 0 OID 0)
-- Dependencies: 207
-- Name: item_id_item_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_item_seq', 1, false);


--
-- TOC entry 3042 (class 0 OID 0)
-- Dependencies: 204
-- Name: pedido_id_pedido_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pedido_id_pedido_seq', 21, true);


--
-- TOC entry 2880 (class 2606 OID 16802)
-- Name: cliente Client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT "Client_pkey" PRIMARY KEY (cpf);


--
-- TOC entry 2882 (class 2606 OID 16823)
-- Name: funcionario Funcionario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT "Funcionario_pkey" PRIMARY KEY (id_funcionario);


--
-- TOC entry 2878 (class 2606 OID 16710)
-- Name: servico Servico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servico
    ADD CONSTRAINT "Servico_pkey" PRIMARY KEY (id_servico);


--
-- TOC entry 2886 (class 2606 OID 16889)
-- Name: carro carro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carro
    ADD CONSTRAINT carro_pkey PRIMARY KEY (placa);


--
-- TOC entry 2888 (class 2606 OID 33126)
-- Name: item item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_pkey PRIMARY KEY (id_item);


--
-- TOC entry 2884 (class 2606 OID 16850)
-- Name: pedido pedido_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_pkey PRIMARY KEY (id_pedido);


--
-- TOC entry 2890 (class 2606 OID 16890)
-- Name: carro carro_cpf_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carro
    ADD CONSTRAINT carro_cpf_fkey FOREIGN KEY (cpf) REFERENCES public.cliente(cpf);


--
-- TOC entry 2891 (class 2606 OID 33127)
-- Name: item item_id_pedido_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_id_pedido_fkey FOREIGN KEY (id_pedido) REFERENCES public.pedido(id_pedido);


--
-- TOC entry 2892 (class 2606 OID 33132)
-- Name: item item_id_servico_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_id_servico_fkey FOREIGN KEY (id_servico) REFERENCES public.servico(id_servico);


--
-- TOC entry 2889 (class 2606 OID 16851)
-- Name: pedido pedido_cpf_cliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_cpf_cliente_fkey FOREIGN KEY (cpf_cliente) REFERENCES public.cliente(cpf);


-- Completed on 2021-01-02 23:00:07

--
-- PostgreSQL database dump complete
--

