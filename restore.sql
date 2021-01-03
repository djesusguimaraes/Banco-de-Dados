--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

-- Started on 2021-01-02 19:17:50

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
-- TOC entry 3050 (class 0 OID 0)
-- Dependencies: 200
-- Name: Servico_ID_servico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Servico_ID_servico_seq" OWNED BY public.servico.id_servico;


--
-- TOC entry 211 (class 1259 OID 16885)
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
    telefone character(14)
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
-- TOC entry 210 (class 1259 OID 16867)
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
-- TOC entry 207 (class 1259 OID 16861)
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
-- TOC entry 3051 (class 0 OID 0)
-- Dependencies: 207
-- Name: item_id_item_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.item_id_item_seq OWNED BY public.item.id_item;


--
-- TOC entry 208 (class 1259 OID 16863)
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
-- TOC entry 3052 (class 0 OID 0)
-- Dependencies: 208
-- Name: item_id_pedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.item_id_pedido_seq OWNED BY public.item.id_pedido;


--
-- TOC entry 209 (class 1259 OID 16865)
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
-- TOC entry 3053 (class 0 OID 0)
-- Dependencies: 209
-- Name: item_id_servico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.item_id_servico_seq OWNED BY public.item.id_servico;


--
-- TOC entry 206 (class 1259 OID 16844)
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
-- TOC entry 205 (class 1259 OID 16842)
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
-- TOC entry 3054 (class 0 OID 0)
-- Dependencies: 205
-- Name: pedido_id_funcionario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pedido_id_funcionario_seq OWNED BY public.pedido.id_funcionario;


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
-- TOC entry 3055 (class 0 OID 0)
-- Dependencies: 204
-- Name: pedido_id_pedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pedido_id_pedido_seq OWNED BY public.pedido.id_pedido;


--
-- TOC entry 2883 (class 2604 OID 16870)
-- Name: item id_item; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item ALTER COLUMN id_item SET DEFAULT nextval('public.item_id_item_seq'::regclass);


--
-- TOC entry 2884 (class 2604 OID 16871)
-- Name: item id_pedido; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item ALTER COLUMN id_pedido SET DEFAULT nextval('public.item_id_pedido_seq'::regclass);


--
-- TOC entry 2885 (class 2604 OID 16872)
-- Name: item id_servico; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item ALTER COLUMN id_servico SET DEFAULT nextval('public.item_id_servico_seq'::regclass);


--
-- TOC entry 2881 (class 2604 OID 16847)
-- Name: pedido id_pedido; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido ALTER COLUMN id_pedido SET DEFAULT nextval('public.pedido_id_pedido_seq'::regclass);


--
-- TOC entry 2882 (class 2604 OID 16848)
-- Name: pedido id_funcionario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido ALTER COLUMN id_funcionario SET DEFAULT nextval('public.pedido_id_funcionario_seq'::regclass);


--
-- TOC entry 2880 (class 2604 OID 16708)
-- Name: servico id_servico; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servico ALTER COLUMN id_servico SET DEFAULT nextval('public."Servico_ID_servico_seq"'::regclass);


--
-- TOC entry 3044 (class 0 OID 16885)
-- Dependencies: 211
-- Data for Name: carro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.carro (placa, modelo, ano, cpf) FROM stdin;
ABC9471	Brasília Amarela    	1985	374.932.473-94
GSK5342	Gol Bola Desandado  	2009	052.350.384-02
JDF0580	Brasília Amarela    	1985	584.059.830-23
KFS4038	Fusca               	2000	085.004.430-98
FDS4989	Jeep a Gás          	1999	058.049.383-42
FDK9853	Girico              	2014	483.049.823-21
JFD9834	Bug                 	2001	873.904.098-02
FJS9442	F250 Cabulosa       	2002	048.348.032-33
TIE8274	D10 Gaisera         	1990	729.372.930-22
KFD9328	Jetta               	2015	408.230.283-02
QER8327	Scania 111          	1978	487.294.327-49
OER7493	Fuscão Preto        	1976	042.340.384-02
IRE9327	Calhambeque         	1950	943.792.301-23
\.


--
-- TOC entry 3035 (class 0 OID 16798)
-- Dependencies: 202
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (nome, cpf, telefone) FROM stdin;
Clésio Moura                                                                    	374.932.473-94	0890580-4830  
Daniel Silva                                                                    	052.350.384-02	9449327-84943 
José Marinho                                                                    	584.059.830-23	4378493-2750  
Jão da Padaria                                                                  	085.004.430-98	8489394-9849  
Mourinho Sousa                                                                  	058.049.383-42	3489347-9839  
Guardiola Silva                                                                 	483.049.823-21	9479349-3842  
Diney Guimarães                                                                 	873.904.098-02	4739432-7009  
Teixeira Peão das Neves                                                         	048.348.032-33	9483847-9983  
Silveirinha da Silva                                                            	729.372.930-22	4937492-6832  
Severino Marques                                                                	408.230.283-02	9347948-7390  
Milionário & José Rico                                                          	487.294.327-49	4983794-8739  
Trio Parada Dura                                                                	042.340.384-02	7865836-4888  
Roberto Carlos                                                                  	943.792.301-23	4973943-0232  
Renato Russo                                                                    	974.293.202-38	9374293-8203  
\.


--
-- TOC entry 3036 (class 0 OID 16819)
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
-- TOC entry 3043 (class 0 OID 16867)
-- Dependencies: 210
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.item (id_item, id_pedido, id_servico, quantidade) FROM stdin;
38	1	15	1
39	2	9	1
40	3	10	2
41	4	13	1
42	5	16	1
43	6	11	2
44	7	19	3
45	8	20	1
\.


--
-- TOC entry 3039 (class 0 OID 16844)
-- Dependencies: 206
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pedido (numero, id_pedido, cpf_cliente, id_funcionario, order_date, preco_total) FROM stdin;
1885	1	042.340.384-02	101	2020-12-30	$300.00
8415	2	374.932.473-94	7799	2020-12-30	$20.00
1645	3	052.350.384-02	9821	2020-12-30	$100.00
8315	4	584.059.830-23	1112	2020-12-30	$160.00
5988	5	483.049.823-21	4739	2020-12-30	$150.00
6659	6	058.049.383-42	1112	2020-12-30	$160.00
2306	7	943.792.301-23	9821	2020-12-30	$900.00
3007	8	974.293.202-38	101	2020-12-30	$350.00
\.


--
-- TOC entry 3034 (class 0 OID 16705)
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
-- TOC entry 3056 (class 0 OID 0)
-- Dependencies: 200
-- Name: Servico_ID_servico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Servico_ID_servico_seq"', 21, true);


--
-- TOC entry 3057 (class 0 OID 0)
-- Dependencies: 207
-- Name: item_id_item_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_item_seq', 47, true);


--
-- TOC entry 3058 (class 0 OID 0)
-- Dependencies: 208
-- Name: item_id_pedido_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_pedido_seq', 27, true);


--
-- TOC entry 3059 (class 0 OID 0)
-- Dependencies: 209
-- Name: item_id_servico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.item_id_servico_seq', 1, false);


--
-- TOC entry 3060 (class 0 OID 0)
-- Dependencies: 205
-- Name: pedido_id_funcionario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pedido_id_funcionario_seq', 1, false);


--
-- TOC entry 3061 (class 0 OID 0)
-- Dependencies: 204
-- Name: pedido_id_pedido_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pedido_id_pedido_seq', 21, true);


--
-- TOC entry 2889 (class 2606 OID 16802)
-- Name: cliente Client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT "Client_pkey" PRIMARY KEY (cpf);


--
-- TOC entry 2891 (class 2606 OID 16823)
-- Name: funcionario Funcionario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT "Funcionario_pkey" PRIMARY KEY (id_funcionario);


--
-- TOC entry 2887 (class 2606 OID 16710)
-- Name: servico Servico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servico
    ADD CONSTRAINT "Servico_pkey" PRIMARY KEY (id_servico);


--
-- TOC entry 2897 (class 2606 OID 16889)
-- Name: carro carro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carro
    ADD CONSTRAINT carro_pkey PRIMARY KEY (placa);


--
-- TOC entry 2895 (class 2606 OID 16874)
-- Name: item item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_pkey PRIMARY KEY (id_item);


--
-- TOC entry 2893 (class 2606 OID 16850)
-- Name: pedido pedido_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_pkey PRIMARY KEY (id_pedido);


--
-- TOC entry 2902 (class 2606 OID 16890)
-- Name: carro carro_cpf_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carro
    ADD CONSTRAINT carro_cpf_fkey FOREIGN KEY (cpf) REFERENCES public.cliente(cpf);


--
-- TOC entry 2900 (class 2606 OID 16875)
-- Name: item item_id_pedido_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_id_pedido_fkey FOREIGN KEY (id_pedido) REFERENCES public.pedido(id_pedido);


--
-- TOC entry 2901 (class 2606 OID 16880)
-- Name: item item_id_servico_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_id_servico_fkey FOREIGN KEY (id_servico) REFERENCES public.servico(id_servico);


--
-- TOC entry 2898 (class 2606 OID 16851)
-- Name: pedido pedido_cpf_cliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_cpf_cliente_fkey FOREIGN KEY (cpf_cliente) REFERENCES public.cliente(cpf);


--
-- TOC entry 2899 (class 2606 OID 16856)
-- Name: pedido pedido_id_funcionario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedido
    ADD CONSTRAINT pedido_id_funcionario_fkey FOREIGN KEY (id_funcionario) REFERENCES public.funcionario(id_funcionario);


-- Completed on 2021-01-02 19:17:52

--
-- PostgreSQL database dump complete
--

