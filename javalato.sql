--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

-- Started on 2021-01-04 15:34:46

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
UTI6181	HB20                	2015	020.392.092-31
KLS3874	Jeep Renegade       	2014	082.038.203-82
TER8734	Mayback S600 Pullman	2017	099.809.803-11
GHS0933	Cadillac SRX        	2011	749.374.938-47
UEW6565	Opala  SS           	1969	094.320.423-78
IUS8934	S10                 	2015	084.034.803-28
HGS9893	Onix                	2018	489.473.986-93
KFJ8723	HB20                	2015	840.348.023-89
KSD8743	Cherry              	2003	903.283.092-89
KJV9823	Frontier            	2020	984.739.462-98
GKS9438	Gaisera             	1990	044.830.482-30
FJS8340	Fuscão preto        	1989	734.304.803-24
IUI9809	HB20                	2015	808.080.808-08
KLI0932	Calhambeque         	1967	040.938.498-09
UTE9899	Jetta               	2004	048.307.232-39
YTY9832	Triton              	2018	090.909.434-23
YRU9382	Kick                	2017	048.047.320-74
JGH0123	Fiesta              	2004	732.648.738-72
LOL8743	F250                	2005	304.830.480-30
\.


--
-- TOC entry 3025 (class 0 OID 16798)
-- Dependencies: 202
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (nome, cpf, telefone, delete_at) FROM stdin;
Daniel                                                                          	808.080.808-08	4830438-4080  	2021-01-04
Jão Roberto Sousa                                                               	048.307.232-39	0098437-8236  	\N
Tarcísio Salgado                                                                	090.909.434-23	0098419-0190  	\N
Gabriel Marques                                                                 	048.047.320-74	4197328-7883  	\N
João Roberto de Barros                                                          	304.830.480-30	0098463-2637  	\N
Emerson Zuckerman                                                               	020.392.092-31	0098523-1233  	\N
Michael Jackson da Silva                                                        	099.809.803-11	0098484-8484  	\N
Sócrates Balbino de Souza                                                       	749.374.938-47	0099932-4341  	\N
Sérgio Martins                                                                  	084.034.803-28	0099343-3421  	\N
Maura Silva Júnior                                                              	840.348.023-89	0093437-8434  	\N
Joana Maria Cunha                                                               	903.283.092-89	0098434-7834  	\N
Hellena Cordeiro Matos                                                          	984.739.462-98	0093232-3232  	\N
Telma de Sá                                                                     	489.473.986-93	0098499-8167  	\N
Roberto Carlos                                                                  	040.938.498-09	0098437-2387  	2021-01-04
Jão da Padaria                                                                  	734.304.803-24	0843048-3049  	2021-01-04
Samuel Braga                                                                    	094.320.423-78	0099231-4345  	2021-01-04
Kevin Teixeira Moura                                                            	082.038.203-82	0099987-2313  	\N
Killian Martins Silva                                                           	732.648.738-72	0099287-4638  	\N
Samuel de Jesus                                                                 	044.830.482-30	0483048-3240  	\N
\.


--
-- TOC entry 3026 (class 0 OID 16819)
-- Dependencies: 203
-- Data for Name: funcionario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.funcionario (nome, cpf, telefone, id_funcionario) FROM stdin;
Davizão                                                                         	222.222.222-22	6398506-4555  	1112
Nérso                                                                           	323.323.434-00	4324112-3421  	101
Brandt                                                                          	444.444.444-44	7799937-6311  	7799
Thays                                                                           	555.555.555-55	6399237-9162  	9821
João Batista                                                                    	047.398.498-32	0099992-3212  	80989
Victor Hugo                                                                     	984.898.943-92	0098467-5412  	6674
Iniesta                                                                         	090.323.874-67	3398323-7231  	7777
Heitor                                                                          	923.759.374-93	0098456-7898  	4739
\.


--
-- TOC entry 3031 (class 0 OID 33121)
-- Dependencies: 208
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.item (id_item, quantidade, id_pedido, id_servico) FROM stdin;
9	1	9	14
34	1	10	12
35	2	11	14
36	2	12	15
37	1	13	16
38	1	14	20
39	1	15	10
40	1	16	18
41	1	17	19
42	1	18	21
43	1	19	14
44	1	20	13
45	1	21	6
46	1	22	16
47	1	23	17
48	2	24	7
49	2	25	9
50	2	26	7
51	2	27	11
52	2	28	15
53	1	29	18
54	1	30	16
55	1	31	19
\.


--
-- TOC entry 3028 (class 0 OID 16844)
-- Dependencies: 205
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pedido (id_pedido, cpf_cliente, order_date, preco_total, id_funcionario) FROM stdin;
10	048.307.232-39	2021-01-04	$140.00	1112
11	090.909.434-23	2021-01-04	$400.00	7799
12	048.047.320-74	2021-01-04	$600.00	101
13	304.830.480-30	2021-01-04	$150.00	7777
14	020.392.092-31	2021-01-04	$350.00	101
15	489.473.986-93	2021-01-04	$50.00	4739
16	840.348.023-89	2021-01-04	$250.00	9821
17	984.739.462-98	2021-01-04	$300.00	7799
18	903.283.092-89	2021-01-04	$100.00	1112
19	084.034.803-28	2021-01-04	$200.00	6674
20	099.809.803-11	2021-01-04	$160.00	7777
21	749.374.938-47	2021-01-04	$40.00	1112
22	048.047.320-74	2021-01-04	$150.00	7799
23	732.648.738-72	2021-01-04	$200.00	101
24	048.307.232-39	2021-01-04	$120.00	80989
25	044.830.482-30	2021-01-04	$40.00	1112
26	984.739.462-98	2021-01-04	$120.00	9821
27	099.809.803-11	2021-01-04	$160.00	80989
28	082.038.203-82	2021-01-04	$600.00	101
29	903.283.092-89	2021-01-04	$250.00	7777
30	984.739.462-98	2021-01-04	$150.00	7777
31	020.392.092-31	2021-01-04	$300.00	7799
9	044.830.482-30	2021-01-04	$200.00	7799
\.


--
-- TOC entry 3024 (class 0 OID 16705)
-- Dependencies: 201
-- Data for Name: servico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servico (nome, descricao, id_servico, preco) FROM stdin;
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
Ducha Simples                                     	Limpeza externa básica                                                                              	9	20
Aplicação de cera                                 	Tratamento com cera para a lataria                                                                  	10	50
\.


--
-- TOC entry 3040 (class 0 OID 0)
-- Dependencies: 200
-- Name: Servico_ID_servico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Servico_ID_servico_seq"', 27, true);


--
-- TOC entry 3041 (class 0 OID 0)
-- Dependencies: 207
-- Name: item_id_item_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_item_seq', 55, true);


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


-- Completed on 2021-01-04 15:34:50

--
-- PostgreSQL database dump complete
--

