-- public.tests definition

-- Drop table

-- DROP TABLE public.tests;

CREATE TABLE public.tests (
	id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY( INCREMENT BY 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1 NO CYCLE),
	"name" varchar NOT NULL,
	CONSTRAINT tests_pk PRIMARY KEY (id)
);


-- public.questions definition

-- Drop table

-- DROP TABLE public.questions;

CREATE TABLE public.questions (
	id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY( INCREMENT BY 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1 NO CYCLE),
	question varchar NOT NULL,
	CONSTRAINT questions_pk PRIMARY KEY (id)
);


-- public.questions4tests definition

-- Drop table

-- DROP TABLE public.questions4tests;

CREATE TABLE public.questions4tests (
	id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY( INCREMENT BY 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1 NO CYCLE),
	test_id INTEGER NOT NULL,
	question_id INTEGER NOT NULL,
	CONSTRAINT questions4tests_pk PRIMARY KEY (id),
	CONSTRAINT questions4tests_fk_question_id FOREIGN KEY (question_id) REFERENCES public.questions(id),
	CONSTRAINT questions4tests_fk_test_id FOREIGN KEY (test_id) REFERENCES public.tests(id)
);


-- public.questions_options definition

-- Drop table

-- DROP TABLE public.questions_options;

CREATE TABLE public.questions_options (
	id INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY( INCREMENT BY 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1 NO CYCLE),
	"option" varchar NOT NULL,
	is_correct bool NOT NULL DEFAULT false,
	question_id INTEGER NOT NULL,
	CONSTRAINT questions_options_pk PRIMARY KEY (id),
	CONSTRAINT questions_options_fk_question_id FOREIGN KEY (question_id) REFERENCES public.questions(id)
);

-- public.tests_results definition

-- Drop table

-- DROP TABLE public.tests_results;

CREATE TABLE public.tests_results (
	id uuid NOT NULL,
	created_at timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	"result" json NOT NULL,
	test_id INTEGER NOT NULL,
	CONSTRAINT tests_results_pk PRIMARY KEY (id),
	CONSTRAINT tests_results_fk_test_id FOREIGN KEY (test_id) REFERENCES public.tests(id)
);

INSERT INTO public.questions (id, question) overriding system value VALUES
(1, '1 + 1 = '),
(2, '2 + 2 = '),
(3, '3 + 3 = '),
(4, '4 + 4 = '),
(5, '5 + 5 = '),
(6, '6 + 6 = '),
(7, '7 + 7 = '),
(8, '8 + 8 = '),
(9, '9 + 9 = '),
(10, '10 + 10 = ');

ALTER TABLE public.questions ALTER COLUMN id RESTART WITH 11;

INSERT INTO public.tests (id, "name") overriding system value VALUES(1, 'Magic Test');

ALTER TABLE public.tests ALTER COLUMN id RESTART WITH 2;

INSERT INTO public.questions_options (id, "option", is_correct, question_id) overriding system value VALUES
(1, '3', false, 1),
(2, '2', true, 1),
(3, '0', false, 1),
(4, '4', true, 2),
(5, '3 + 1', true, 2),
(6, '10', false, 2),
(7, '1 + 5', true, 3),
(8, '1', false, 3),
(9, '6', true, 3),
(10, '2 + 4', true, 3),
(11, '8', true, 4),
(12, '4', false, 4),
(13, '0', false, 4),
(14, '0 + 8', true, 4),
(15, '6', false, 5),
(16, '18', false, 5),
(17, '10', true, 5),
(18, '9', false, 5),
(19, '0', false, 5),
(20, '3', false, 6),
(21, '9', false, 6),
(22, '0', false, 6),
(23, '12', true, 6),
(24, '5 + 7', true, 6),
(25, '5', false, 7),
(26, '14', true, 7),
(27, '16', true, 8),
(28, '12', false, 8),
(29, '9', false, 8),
(30, '5', false, 8),
(31, '18', true, 9),
(32, '9', false, 9),
(33, '17 + 1', true, 9),
(34, '2 + 16', true, 9),
(35, '0', false, 10),
(36, '2', false, 10),
(37, '8', false, 10),
(38, '20', true, 10);

ALTER TABLE public.questions_options ALTER COLUMN id RESTART WITH 39;

INSERT INTO public.questions4tests (id, test_id, question_id) overriding system value VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10);

ALTER TABLE public.questions4tests ALTER COLUMN id RESTART WITH 11;