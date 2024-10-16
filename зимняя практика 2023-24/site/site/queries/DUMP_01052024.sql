PGDMP          
            |            testdb    16.2    16.2 �    s           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            t           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            u           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            v           1262    16397    testdb    DATABASE     z   CREATE DATABASE testdb WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Russian_Russia.1251';
    DROP DATABASE testdb;
                postgres    false            �            1259    115268    buses    TABLE       CREATE TABLE public.buses (
    id bigint NOT NULL,
    model_id integer NOT NULL,
    number text NOT NULL,
    status character varying(255) NOT NULL,
    seats integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.buses;
       public         heap    postgres    false            �            1259    115267    buses_id_seq    SEQUENCE     u   CREATE SEQUENCE public.buses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.buses_id_seq;
       public          postgres    false    231            w           0    0    buses_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.buses_id_seq OWNED BY public.buses.id;
          public          postgres    false    230            �            1259    115254    carriers    TABLE     �   CREATE TABLE public.carriers (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.carriers;
       public         heap    postgres    false            �            1259    115253    carriers_id_seq    SEQUENCE     x   CREATE SEQUENCE public.carriers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.carriers_id_seq;
       public          postgres    false    227            x           0    0    carriers_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.carriers_id_seq OWNED BY public.carriers.id;
          public          postgres    false    226            �            1259    115261    cities    TABLE     �   CREATE TABLE public.cities (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.cities;
       public         heap    postgres    false            �            1259    115260    cities_id_seq    SEQUENCE     v   CREATE SEQUENCE public.cities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cities_id_seq;
       public          postgres    false    229            y           0    0    cities_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.cities_id_seq OWNED BY public.cities.id;
          public          postgres    false    228            �            1259    115353    comments    TABLE     �   CREATE TABLE public.comments (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    customer_id integer NOT NULL,
    comment text NOT NULL
);
    DROP TABLE public.comments;
       public         heap    postgres    false            �            1259    115352    comments_id_seq    SEQUENCE     x   CREATE SEQUENCE public.comments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.comments_id_seq;
       public          postgres    false    253            z           0    0    comments_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.comments_id_seq OWNED BY public.comments.id;
          public          postgres    false    252            �            1259    115337 	   customers    TABLE     �  CREATE TABLE public.customers (
    id bigint NOT NULL,
    surname character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    passport_series integer NOT NULL,
    passport_number integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    role integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.customers;
       public         heap    postgres    false            �            1259    115336    customers_id_seq    SEQUENCE     y   CREATE SEQUENCE public.customers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.customers_id_seq;
       public          postgres    false    249            {           0    0    customers_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.customers_id_seq OWNED BY public.customers.id;
          public          postgres    false    248            �            1259    115223    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    115222    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    221            |           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    220            �            1259    115323    licences    TABLE     �   CREATE TABLE public.licences (
    id bigint NOT NULL,
    licence_type character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.licences;
       public         heap    postgres    false            �            1259    115322    licences_id_seq    SEQUENCE     x   CREATE SEQUENCE public.licences_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.licences_id_seq;
       public          postgres    false    245            }           0    0    licences_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.licences_id_seq OWNED BY public.licences.id;
          public          postgres    false    244            �            1259    16399 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    16398    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216            ~           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    115277    model_buses    TABLE     �   CREATE TABLE public.model_buses (
    id bigint NOT NULL,
    brand character varying(255) NOT NULL,
    model character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.model_buses;
       public         heap    postgres    false            �            1259    115276    model_buses_id_seq    SEQUENCE     {   CREATE SEQUENCE public.model_buses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.model_buses_id_seq;
       public          postgres    false    233                       0    0    model_buses_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.model_buses_id_seq OWNED BY public.model_buses.id;
          public          postgres    false    232            �            1259    115215    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    115235    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    115234    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    223            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    222            �            1259    115300    routes    TABLE     �   CREATE TABLE public.routes (
    id bigint NOT NULL,
    departure_city_id integer NOT NULL,
    arrival_city_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.routes;
       public         heap    postgres    false            �            1259    115299    routes_id_seq    SEQUENCE     v   CREATE SEQUENCE public.routes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.routes_id_seq;
       public          postgres    false    239            �           0    0    routes_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.routes_id_seq OWNED BY public.routes.id;
          public          postgres    false    238            �            1259    115293    runs    TABLE     �  CREATE TABLE public.runs (
    id bigint NOT NULL,
    driver_id integer NOT NULL,
    bus_id integer NOT NULL,
    route_id integer NOT NULL,
    departure_time timestamp(0) without time zone NOT NULL,
    arrival_time timestamp(0) without time zone NOT NULL,
    status character varying(255) NOT NULL,
    carrier_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.runs;
       public         heap    postgres    false            �            1259    115292    runs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.runs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.runs_id_seq;
       public          postgres    false    237            �           0    0    runs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.runs_id_seq OWNED BY public.runs.id;
          public          postgres    false    236            �            1259    115330 	   seat_runs    TABLE     ,  CREATE TABLE public.seat_runs (
    id bigint NOT NULL,
    seat_id integer NOT NULL,
    run_id integer NOT NULL,
    customer_id integer NOT NULL,
    flag integer NOT NULL,
    price integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.seat_runs;
       public         heap    postgres    false            �            1259    115329    seat_runs_id_seq    SEQUENCE     y   CREATE SEQUENCE public.seat_runs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.seat_runs_id_seq;
       public          postgres    false    247            �           0    0    seat_runs_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.seat_runs_id_seq OWNED BY public.seat_runs.id;
          public          postgres    false    246            �            1259    115346    seats    TABLE     �   CREATE TABLE public.seats (
    id bigint NOT NULL,
    bus_id integer NOT NULL,
    number integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.seats;
       public         heap    postgres    false            �            1259    115345    seats_id_seq    SEQUENCE     u   CREATE SEQUENCE public.seats_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.seats_id_seq;
       public          postgres    false    251            �           0    0    seats_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.seats_id_seq OWNED BY public.seats.id;
          public          postgres    false    250            �            1259    115314    stuffs    TABLE     �  CREATE TABLE public.stuffs (
    id bigint NOT NULL,
    surname character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    patronymic character varying(255) NOT NULL,
    licence_id integer NOT NULL,
    health_status integer NOT NULL,
    title_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.stuffs;
       public         heap    postgres    false            �            1259    115313    stuffs_id_seq    SEQUENCE     v   CREATE SEQUENCE public.stuffs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.stuffs_id_seq;
       public          postgres    false    243            �           0    0    stuffs_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.stuffs_id_seq OWNED BY public.stuffs.id;
          public          postgres    false    242            �            1259    115247    test_models    TABLE     �   CREATE TABLE public.test_models (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    number integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.test_models;
       public         heap    postgres    false            �            1259    115246    test_models_id_seq    SEQUENCE     {   CREATE SEQUENCE public.test_models_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.test_models_id_seq;
       public          postgres    false    225            �           0    0    test_models_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.test_models_id_seq OWNED BY public.test_models.id;
          public          postgres    false    224            �            1259    115286    tickets    TABLE     %  CREATE TABLE public.tickets (
    id bigint NOT NULL,
    seat_run_id integer NOT NULL,
    customer_id integer NOT NULL,
    carrier_id integer NOT NULL,
    code character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.tickets;
       public         heap    postgres    false            �            1259    115285    tickets_id_seq    SEQUENCE     w   CREATE SEQUENCE public.tickets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.tickets_id_seq;
       public          postgres    false    235            �           0    0    tickets_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.tickets_id_seq OWNED BY public.tickets.id;
          public          postgres    false    234            �            1259    115307    titles    TABLE     �   CREATE TABLE public.titles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    salary integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.titles;
       public         heap    postgres    false            �            1259    115306    titles_id_seq    SEQUENCE     v   CREATE SEQUENCE public.titles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.titles_id_seq;
       public          postgres    false    241            �           0    0    titles_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.titles_id_seq OWNED BY public.titles.id;
          public          postgres    false    240            �            1259    115205    users    TABLE     x  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    115204    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    218            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    217            �           2604    115271    buses id    DEFAULT     d   ALTER TABLE ONLY public.buses ALTER COLUMN id SET DEFAULT nextval('public.buses_id_seq'::regclass);
 7   ALTER TABLE public.buses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    230    231    231            ~           2604    115257    carriers id    DEFAULT     j   ALTER TABLE ONLY public.carriers ALTER COLUMN id SET DEFAULT nextval('public.carriers_id_seq'::regclass);
 :   ALTER TABLE public.carriers ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    227    227                       2604    115264 	   cities id    DEFAULT     f   ALTER TABLE ONLY public.cities ALTER COLUMN id SET DEFAULT nextval('public.cities_id_seq'::regclass);
 8   ALTER TABLE public.cities ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    228    229            �           2604    115356    comments id    DEFAULT     j   ALTER TABLE ONLY public.comments ALTER COLUMN id SET DEFAULT nextval('public.comments_id_seq'::regclass);
 :   ALTER TABLE public.comments ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    253    252    253            �           2604    115340    customers id    DEFAULT     l   ALTER TABLE ONLY public.customers ALTER COLUMN id SET DEFAULT nextval('public.customers_id_seq'::regclass);
 ;   ALTER TABLE public.customers ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    248    249    249            z           2604    115226    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    221    221            �           2604    115326    licences id    DEFAULT     j   ALTER TABLE ONLY public.licences ALTER COLUMN id SET DEFAULT nextval('public.licences_id_seq'::regclass);
 :   ALTER TABLE public.licences ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    244    245    245            x           2604    16402    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    216    216            �           2604    115280    model_buses id    DEFAULT     p   ALTER TABLE ONLY public.model_buses ALTER COLUMN id SET DEFAULT nextval('public.model_buses_id_seq'::regclass);
 =   ALTER TABLE public.model_buses ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    233    232    233            |           2604    115238    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    223    223            �           2604    115303 	   routes id    DEFAULT     f   ALTER TABLE ONLY public.routes ALTER COLUMN id SET DEFAULT nextval('public.routes_id_seq'::regclass);
 8   ALTER TABLE public.routes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    238    239    239            �           2604    115296    runs id    DEFAULT     b   ALTER TABLE ONLY public.runs ALTER COLUMN id SET DEFAULT nextval('public.runs_id_seq'::regclass);
 6   ALTER TABLE public.runs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    237    236    237            �           2604    115333    seat_runs id    DEFAULT     l   ALTER TABLE ONLY public.seat_runs ALTER COLUMN id SET DEFAULT nextval('public.seat_runs_id_seq'::regclass);
 ;   ALTER TABLE public.seat_runs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    246    247    247            �           2604    115349    seats id    DEFAULT     d   ALTER TABLE ONLY public.seats ALTER COLUMN id SET DEFAULT nextval('public.seats_id_seq'::regclass);
 7   ALTER TABLE public.seats ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    250    251    251            �           2604    115317 	   stuffs id    DEFAULT     f   ALTER TABLE ONLY public.stuffs ALTER COLUMN id SET DEFAULT nextval('public.stuffs_id_seq'::regclass);
 8   ALTER TABLE public.stuffs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    243    242    243            }           2604    115250    test_models id    DEFAULT     p   ALTER TABLE ONLY public.test_models ALTER COLUMN id SET DEFAULT nextval('public.test_models_id_seq'::regclass);
 =   ALTER TABLE public.test_models ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    224    225    225            �           2604    115289 
   tickets id    DEFAULT     h   ALTER TABLE ONLY public.tickets ALTER COLUMN id SET DEFAULT nextval('public.tickets_id_seq'::regclass);
 9   ALTER TABLE public.tickets ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    235    234    235            �           2604    115310 	   titles id    DEFAULT     f   ALTER TABLE ONLY public.titles ALTER COLUMN id SET DEFAULT nextval('public.titles_id_seq'::regclass);
 8   ALTER TABLE public.titles ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    240    241    241            y           2604    115208    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    217    218            Z          0    115268    buses 
   TABLE DATA           \   COPY public.buses (id, model_id, number, status, seats, created_at, updated_at) FROM stdin;
    public          postgres    false    231   ��       V          0    115254    carriers 
   TABLE DATA           D   COPY public.carriers (id, name, created_at, updated_at) FROM stdin;
    public          postgres    false    227   �       X          0    115261    cities 
   TABLE DATA           B   COPY public.cities (id, name, created_at, updated_at) FROM stdin;
    public          postgres    false    229   D�       p          0    115353    comments 
   TABLE DATA           T   COPY public.comments (id, created_at, updated_at, customer_id, comment) FROM stdin;
    public          postgres    false    253   ��       l          0    115337 	   customers 
   TABLE DATA           �   COPY public.customers (id, surname, name, passport_series, passport_number, email, password, role, created_at, updated_at) FROM stdin;
    public          postgres    false    249   ��       P          0    115223    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    221   Y�       h          0    115323    licences 
   TABLE DATA           L   COPY public.licences (id, licence_type, created_at, updated_at) FROM stdin;
    public          postgres    false    245   v�       K          0    16399 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    216   ��       \          0    115277    model_buses 
   TABLE DATA           O   COPY public.model_buses (id, brand, model, created_at, updated_at) FROM stdin;
    public          postgres    false    233   ʧ       N          0    115215    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    219   [�       R          0    115235    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    223   x�       b          0    115300    routes 
   TABLE DATA           `   COPY public.routes (id, departure_city_id, arrival_city_id, created_at, updated_at) FROM stdin;
    public          postgres    false    239   ��       `          0    115293    runs 
   TABLE DATA           �   COPY public.runs (id, driver_id, bus_id, route_id, departure_time, arrival_time, status, carrier_id, created_at, updated_at) FROM stdin;
    public          postgres    false    237   ¨       j          0    115330 	   seat_runs 
   TABLE DATA           j   COPY public.seat_runs (id, seat_id, run_id, customer_id, flag, price, created_at, updated_at) FROM stdin;
    public          postgres    false    247   �       n          0    115346    seats 
   TABLE DATA           K   COPY public.seats (id, bus_id, number, created_at, updated_at) FROM stdin;
    public          postgres    false    251   ^�       f          0    115314    stuffs 
   TABLE DATA           |   COPY public.stuffs (id, surname, name, patronymic, licence_id, health_status, title_id, created_at, updated_at) FROM stdin;
    public          postgres    false    243   �       T          0    115247    test_models 
   TABLE DATA           O   COPY public.test_models (id, name, number, created_at, updated_at) FROM stdin;
    public          postgres    false    225   �       ^          0    115286    tickets 
   TABLE DATA           i   COPY public.tickets (id, seat_run_id, customer_id, carrier_id, code, created_at, updated_at) FROM stdin;
    public          postgres    false    235   $�       d          0    115307    titles 
   TABLE DATA           J   COPY public.titles (id, name, salary, created_at, updated_at) FROM stdin;
    public          postgres    false    241   A�       M          0    115205    users 
   TABLE DATA           u   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    218   ^�       �           0    0    buses_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.buses_id_seq', 2, true);
          public          postgres    false    230            �           0    0    carriers_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.carriers_id_seq', 3, true);
          public          postgres    false    226            �           0    0    cities_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.cities_id_seq', 4, true);
          public          postgres    false    228            �           0    0    comments_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.comments_id_seq', 1, false);
          public          postgres    false    252            �           0    0    customers_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.customers_id_seq', 3, true);
          public          postgres    false    248            �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    220            �           0    0    licences_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.licences_id_seq', 1, false);
          public          postgres    false    244            �           0    0    migrations_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.migrations_id_seq', 149, true);
          public          postgres    false    215            �           0    0    model_buses_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.model_buses_id_seq', 5, true);
          public          postgres    false    232            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    222            �           0    0    routes_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.routes_id_seq', 2, true);
          public          postgres    false    238            �           0    0    runs_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.runs_id_seq', 8, true);
          public          postgres    false    236            �           0    0    seat_runs_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.seat_runs_id_seq', 80, true);
          public          postgres    false    246            �           0    0    seats_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.seats_id_seq', 25, true);
          public          postgres    false    250            �           0    0    stuffs_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.stuffs_id_seq', 1, false);
          public          postgres    false    242            �           0    0    test_models_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.test_models_id_seq', 1, false);
          public          postgres    false    224            �           0    0    tickets_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.tickets_id_seq', 9, true);
          public          postgres    false    234            �           0    0    titles_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.titles_id_seq', 1, false);
          public          postgres    false    240            �           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 1, false);
          public          postgres    false    217            �           2606    115275    buses buses_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.buses
    ADD CONSTRAINT buses_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.buses DROP CONSTRAINT buses_pkey;
       public            postgres    false    231            �           2606    115259    carriers carriers_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.carriers
    ADD CONSTRAINT carriers_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.carriers DROP CONSTRAINT carriers_pkey;
       public            postgres    false    227            �           2606    115266    cities cities_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cities DROP CONSTRAINT cities_pkey;
       public            postgres    false    229            �           2606    115360    comments comments_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.comments DROP CONSTRAINT comments_pkey;
       public            postgres    false    253            �           2606    115344    customers customers_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.customers
    ADD CONSTRAINT customers_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.customers DROP CONSTRAINT customers_pkey;
       public            postgres    false    249            �           2606    115231    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    221            �           2606    115233 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    221            �           2606    115328    licences licences_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.licences
    ADD CONSTRAINT licences_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.licences DROP CONSTRAINT licences_pkey;
       public            postgres    false    245            �           2606    16404    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            �           2606    115284    model_buses model_buses_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.model_buses
    ADD CONSTRAINT model_buses_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.model_buses DROP CONSTRAINT model_buses_pkey;
       public            postgres    false    233            �           2606    115221 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    219            �           2606    115242 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    223            �           2606    115245 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    223            �           2606    115305    routes routes_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.routes
    ADD CONSTRAINT routes_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.routes DROP CONSTRAINT routes_pkey;
       public            postgres    false    239            �           2606    115298    runs runs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.runs
    ADD CONSTRAINT runs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.runs DROP CONSTRAINT runs_pkey;
       public            postgres    false    237            �           2606    115335    seat_runs seat_runs_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.seat_runs
    ADD CONSTRAINT seat_runs_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.seat_runs DROP CONSTRAINT seat_runs_pkey;
       public            postgres    false    247            �           2606    115351    seats seats_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.seats
    ADD CONSTRAINT seats_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.seats DROP CONSTRAINT seats_pkey;
       public            postgres    false    251            �           2606    115321    stuffs stuffs_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.stuffs
    ADD CONSTRAINT stuffs_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.stuffs DROP CONSTRAINT stuffs_pkey;
       public            postgres    false    243            �           2606    115252    test_models test_models_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.test_models
    ADD CONSTRAINT test_models_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.test_models DROP CONSTRAINT test_models_pkey;
       public            postgres    false    225            �           2606    115291    tickets tickets_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.tickets DROP CONSTRAINT tickets_pkey;
       public            postgres    false    235            �           2606    115312    titles titles_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.titles
    ADD CONSTRAINT titles_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.titles DROP CONSTRAINT titles_pkey;
       public            postgres    false    241            �           2606    115214    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    218            �           2606    115212    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    218            �           1259    115243 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    223    223            Z   3   x�3�4�0������M�<C�? �2�4AHY�rq�B�b���� 5$      V   T   x�3�0��| ��{/컰�3����8/�A��/l��pa+Pž�/�_�qa��!T�1T�B 5�|O����qqq C�2      X   J   x�3�0�b�Ŧ�6\l����ދ=�1~@�e�yaP`;��1��[.l�rM8/̹��b�]6�c���� �)�      p      x������ � �      l   �   x�3�0�¦.콰��&8����N)�,K54305200vH�M���K���4�4���".#�/칰�b̠��^l���i`De�V��'�d��9��)*E2����{.�s� � mHN0�j����� ��O�      P      x������ � �      h      x������ � �      K   '  x�e��n� �����0��e�E�+eM�D{��v��F���3�)@#���d�)DL���t�d�B���}�b�H	���V��P'#w��������S8�O�[�+���s��c&�2[�r1��tń���R���O�yNe�Sp6���a`�Q��s��fG���d/9��8j
�h�Z0���i�ݝR�\���NOKN�F�{jZP�Uӫ��4��Q'�~�լa� J���hsMe��ʾc���|�k@����fݚ�pP}]�F_+<~<!�,q8���U��g�u�      \   �   x�3��M-JNMI-�uJͫ�.(��+I-�4202�50�5�T04�26�25�&�e���S��iin`@�&c���ļ�Dΐ�R�}�Dk4��u������+Vp�OL� Z�)�gYjr>�sQ~qqyb%�c���� ��BF      N      x������ � �      R      x������ � �      b      x�3�4�4��".# �ʎ���� Iv�      `   5   x���4B#N##]]#SC#+C+�����T� �:���b���� V@
�      j   G   x�mʻ 1���s�� K�����Փ�0���T������,�񬡘s�.V��Qh�u���OD.C�$�      n   |   x�=���0��q1�%�M���_�j���^�qA�}t�"&7qK��<�#y�g���-��G|�QCV�Bf5x�s�	-GװC�zL��4���'���	�'|ߏ8�W0*�F��ޥ�]9�      f      x������ � �      T      x������ � �      ^      x������ � �      d      x������ � �      M      x������ � �     