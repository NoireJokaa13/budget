--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2
-- Dumped by pg_dump version 13.2

-- Started on 2022-07-29 00:15:19

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


CREATE DATABASE budget
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'English_Malaysia.1252'
    LC_CTYPE = 'English_Malaysia.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

--
-- TOC entry 201 (class 1259 OID 16434)
-- Name: budget; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.budget (
    budget_id integer NOT NULL,
    work_id character varying(20) NOT NULL,
    title character varying(200) NOT NULL,
    justify character varying(50) NOT NULL,
    budget_type character varying(50) NOT NULL,
    usage_type character varying(50) NOT NULL,
    fulltotal money NOT NULL,
    status character varying(50) NOT NULL,
    dean_id character varying(20),
    status_dean character varying(20),
    bursary_id character varying(20),
    status_bursary character varying(20),
    create_dated date NOT NULL,
    update_dated date,
    dean_approve_dated date,
    bursary_approve_dated date,
    remark_dean text,
    remark_bursary text
);


ALTER TABLE public.budget OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 16440)
-- Name: budget_budget_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.budget ALTER COLUMN budget_id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.budget_budget_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 203 (class 1259 OID 16444)
-- Name: budget_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.budget_items (
    item_id integer NOT NULL,
    budget_id integer NOT NULL,
    name character varying(200) NOT NULL,
    type character varying(50) NOT NULL,
    justification character varying(50) NOT NULL,
    price character varying(20) NOT NULL,
    qty integer NOT NULL,
    uom character varying(50) NOT NULL,
    total character varying(20) NOT NULL,
    create_dated date NOT NULL,
    update_dated date
);


ALTER TABLE public.budget_items OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16447)
-- Name: budget_items_item_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.budget_items ALTER COLUMN item_id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.budget_items_item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 200 (class 1259 OID 16388)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    work_id character varying(11) NOT NULL,
    name character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    centre_code character varying(20),
    role character varying(20) NOT NULL,
    status character varying(20) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 2867 (class 2606 OID 16458)
-- Name: budget_items budget_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.budget_items
    ADD CONSTRAINT budget_items_pkey PRIMARY KEY (item_id);


--
-- TOC entry 2865 (class 2606 OID 16443)
-- Name: budget budget_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.budget
    ADD CONSTRAINT budget_pkey PRIMARY KEY (budget_id);


--
-- TOC entry 2863 (class 2606 OID 16394)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (work_id);


-- Completed on 2022-07-29 00:15:19

--
-- PostgreSQL database dump complete
--



INSERT INTO public.budget (budget_id, work_id, title, justify, budget_type, usage_type, fulltotal, status, dean_id, status_dean, bursary_id, status_bursary, create_dated, update_dated, dean_approve_dated, bursary_approve_dated, remark_dean, remark_bursary) OVERRIDING SYSTEM VALUE VALUES (11, 'U123456', 'PEMBELIAN SET DESKTOP & ALATAN ICT BAGI KEGUNAAN STAF BAHARU', 'UNTUK KEGUNAAN STAF BAHARU', 'BM', 'Procurement', 'RM39,900.00', 'Approved', NULL, 'Approved', 'B123456', 'Approved', '2022-07-28', '2022-07-28', '2022-07-28', '2022-07-28', '', '');
INSERT INTO public.budget (budget_id, work_id, title, justify, budget_type, usage_type, fulltotal, status, dean_id, status_dean, bursary_id, status_bursary, create_dated, update_dated, dean_approve_dated, bursary_approve_dated, remark_dean, remark_bursary) OVERRIDING SYSTEM VALUE VALUES (12, 'U012345', 'PEMBELIAN iPAD', 'UNTUK KEGUNAAN PEMBELAJARAN', 'BM', 'Procurement', 'RM21,596.00', 'Waiting for Approval From Bursary', 'D012345', 'Approved', NULL, NULL, '2022-07-28', NULL, '2022-07-28', NULL, '', NULL);
INSERT INTO public.budget (budget_id, work_id, title, justify, budget_type, usage_type, fulltotal, status, dean_id, status_dean, bursary_id, status_bursary, create_dated, update_dated, dean_approve_dated, bursary_approve_dated, remark_dean, remark_bursary) OVERRIDING SYSTEM VALUE VALUES (8, 'U123456', 'PEMBELIAN SET DESKTOP', 'UNTUK KEGUNAAN STAF', 'BM', 'Procurement', 'RM15,000.00', 'Waiting for Approval', NULL, NULL, NULL, NULL, '2022-07-28', '2022-07-28', NULL, NULL, NULL, NULL);
INSERT INTO public.budget (budget_id, work_id, title, justify, budget_type, usage_type, fulltotal, status, dean_id, status_dean, bursary_id, status_bursary, create_dated, update_dated, dean_approve_dated, bursary_approve_dated, remark_dean, remark_bursary) OVERRIDING SYSTEM VALUE VALUES (9, 'U123456', 'PEMBELIAN ALATAN ICT', 'BAJET FAKULTI TIDAK MENGCUKUPI', 'BM', 'Procurement', 'RM26,400.00', 'Waiting for Approval', NULL, NULL, NULL, NULL, '2022-07-28', '2022-07-28', NULL, NULL, NULL, NULL);
INSERT INTO public.budget (budget_id, work_id, title, justify, budget_type, usage_type, fulltotal, status, dean_id, status_dean, bursary_id, status_bursary, create_dated, update_dated, dean_approve_dated, bursary_approve_dated, remark_dean, remark_bursary) OVERRIDING SYSTEM VALUE VALUES (7, 'U123456', 'PEMBELIAN iPAD', 'UNTUK KEGUNAAN STAF', 'BM', 'Procurement', 'RM12,618.00', 'Waiting for Approval', NULL, NULL, NULL, NULL, '2021-07-28', '2022-07-28', NULL, NULL, NULL, NULL);



INSERT INTO public.budget_items (item_id, budget_id, name, type, justification, price, qty, uom, total, create_dated, update_dated) OVERRIDING SYSTEM VALUE VALUES (20, 11, 'HP PRODESK', 'Asset', 'Replace', '3300.00', 12, 'UNIT', '39600.00', '2022-07-28', NULL);
INSERT INTO public.budget_items (item_id, budget_id, name, type, justification, price, qty, uom, total, create_dated, update_dated) OVERRIDING SYSTEM VALUE VALUES (21, 11, 'SPEAKER', 'Asset', 'New', '25.00', 12, 'UNIT', '300.00', '2022-07-28', NULL);
INSERT INTO public.budget_items (item_id, budget_id, name, type, justification, price, qty, uom, total, create_dated, update_dated) OVERRIDING SYSTEM VALUE VALUES (22, 12, 'iPAD GENENARATION 8', 'Asset', 'New', '5399', 4, 'UNIT', '21596.00', '2022-07-28', NULL);
INSERT INTO public.budget_items (item_id, budget_id, name, type, justification, price, qty, uom, total, create_dated, update_dated) OVERRIDING SYSTEM VALUE VALUES (23, 8, 'Dell', 'Asset', 'New', '5000', 3, 'UNIT', '15000.00', '2022-07-28', NULL);
INSERT INTO public.budget_items (item_id, budget_id, name, type, justification, price, qty, uom, total, create_dated, update_dated) OVERRIDING SYSTEM VALUE VALUES (24, 9, 'HP PRODESK', 'Asset', 'New', '3300.00', 8, 'UNIT', '26400.00', '2022-07-28', NULL);
INSERT INTO public.budget_items (item_id, budget_id, name, type, justification, price, qty, uom, total, create_dated, update_dated) OVERRIDING SYSTEM VALUE VALUES (25, 7, 'IPAD', 'Asset', 'New', '6309.00', 2, 'UNIT', '12618.00', '2022-07-28', NULL);
INSERT INTO public.budget_items (item_id, budget_id, name, type, justification, price, qty, uom, total, create_dated, update_dated) OVERRIDING SYSTEM VALUE VALUES (26, 9, 'SPEAKER', 'Asset', 'Replace', '35.00', 3, 'UNIT', '105.00', '2022-07-28', NULL);



INSERT INTO public.users (work_id, name, password, centre_code, role, status) VALUES ('B123456', 'Bursary Department', 'E10ADC3949BA59ABBE56E057F20F883E', 'BENDAHARI', 'bursary', 'active');
INSERT INTO public.users (work_id, name, password, centre_code, role, status) VALUES ('D123456', 'Dean of FSKTM', 'E10ADC3949BA59ABBE56E057F20F883E', 'FSKTM', 'dean', 'active');
INSERT INTO public.users (work_id, name, password, centre_code, role, status) VALUES ('U123456', 'FSKTM Accountant', 'E10ADC3949BA59ABBE56E057F20F883E', 'FSKTM', 'accountant', 'active');
INSERT INTO public.users (work_id, name, password, centre_code, role, status) VALUES ('U012345', 'EDUCATION Accountant', 'E10ADC3949BA59ABBE56E057F20F883E', 'EDUCATION', 'accountant', 'active');
INSERT INTO public.users (work_id, name, password, centre_code, role, status) VALUES ('D012345', 'Dean of EDUCATION', 'E10ADC3949BA59ABBE56E057F20F883E', 'EDUCATION', 'dean', 'active');
