/*
 Navicat Premium Data Transfer

 Source Server         : server
 Source Server Type    : PostgreSQL
 Source Server Version : 110005
 Source Host           : 192.168.99.133:5432
 Source Catalog        : SIPOP
 Source Schema         : dbo

 Target Server Type    : PostgreSQL
 Target Server Version : 110005
 File Encoding         : 65001

 Date: 19/06/2024 09:44:42
*/


-- ----------------------------
-- Type structure for tablefunc_crosstab_2
-- ----------------------------
DROP TYPE IF EXISTS "dbo"."tablefunc_crosstab_2";
CREATE TYPE "dbo"."tablefunc_crosstab_2" AS (
  "row_name" text COLLATE "pg_catalog"."default",
  "category_1" text COLLATE "pg_catalog"."default",
  "category_2" text COLLATE "pg_catalog"."default"
);
ALTER TYPE "dbo"."tablefunc_crosstab_2" OWNER TO "postgres";

-- ----------------------------
-- Type structure for tablefunc_crosstab_3
-- ----------------------------
DROP TYPE IF EXISTS "dbo"."tablefunc_crosstab_3";
CREATE TYPE "dbo"."tablefunc_crosstab_3" AS (
  "row_name" text COLLATE "pg_catalog"."default",
  "category_1" text COLLATE "pg_catalog"."default",
  "category_2" text COLLATE "pg_catalog"."default",
  "category_3" text COLLATE "pg_catalog"."default"
);
ALTER TYPE "dbo"."tablefunc_crosstab_3" OWNER TO "postgres";

-- ----------------------------
-- Type structure for tablefunc_crosstab_4
-- ----------------------------
DROP TYPE IF EXISTS "dbo"."tablefunc_crosstab_4";
CREATE TYPE "dbo"."tablefunc_crosstab_4" AS (
  "row_name" text COLLATE "pg_catalog"."default",
  "category_1" text COLLATE "pg_catalog"."default",
  "category_2" text COLLATE "pg_catalog"."default",
  "category_3" text COLLATE "pg_catalog"."default",
  "category_4" text COLLATE "pg_catalog"."default"
);
ALTER TYPE "dbo"."tablefunc_crosstab_4" OWNER TO "postgres";

-- ----------------------------
-- Sequence structure for dt_absen_id_absen
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_absen_id_absen";
CREATE SEQUENCE "dbo"."dt_absen_id_absen" 
INCREMENT 1
MINVALUE  1
MAXVALUE 987654321
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_action_log_id_action_log_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_action_log_id_action_log_id_seq";
CREATE SEQUENCE "dbo"."dt_action_log_id_action_log_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_app_trans_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_app_trans_id_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_app_trans_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_bank_deposit_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_bank_deposit_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_bank_deposit_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_bank_payment_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_bank_payment_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_bank_payment_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_bank_transfer_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_bank_transfer_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_bank_transfer_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_consumable_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_consumable_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_consumable_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_customer_invoice_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_customer_invoice_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_customer_invoice_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_customer_payment_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_customer_payment_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_customer_payment_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_delivery_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_delivery_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_delivery_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_grn_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_grn_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_grn_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_journal_entry_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_journal_entry_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_journal_entry_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_stock_adjustment_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_stock_adjustment_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_stock_adjustment_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_stock_opname_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_stock_opname_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_stock_opname_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_supplier_invoice_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_supplier_invoice_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_supplier_invoice_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_supplier_payment_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_supplier_payment_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_supplier_payment_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for dt_app_trans_work_order_costing_period_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "dbo"."dt_app_trans_work_order_costing_period_seq";
CREATE SEQUENCE "dbo"."dt_app_trans_work_order_costing_period_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;
