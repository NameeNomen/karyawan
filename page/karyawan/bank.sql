-- create database bank;
-- use bank;

--     create table cabang(
--         kode_cabang int(10) PRIMARY key not null ,
--         nama_cabang varchar(50) not null,
--         alamat_cabang text not null,
--         created_at timestamp DEFAULT current_timestamp()null,
--         updated_at timestamp DEFAULT null,
-- );
-- create table nasabah(
--     kode_tabungan int(15) primary key not null,
--     no_rekening int(30) not null,
--     nama varchar(100) not null,
--     alamat_nasabah text not null,
--     saldo int not null
-- );
-- create table jenis_tabungan(
--     kode_tabungan int(15) not null,
--     CONSTRAINT fk_jenis_tabungan_nasabah foreign key (kode_tabungan) references nasabah(kode_tabungan) on delete cascade on update cascade,
--     jenis_tabungan varchar(50) not null,
-- );
-- create table transaksi(
--     no_transaksi int(20) not null PRIMARY key,
--     tgl_transaksi date not null,
--     kode_cabang int(10) not null,
--     CONSTRAINT fk_transaksi_cabang foreign key (kode_cabang) references cabang (kode_cabang) on delete cascade on delete cascade,

-- );

-- create table detailTransaksi(
--     no_transaksi int(20) not null,
--     constraint fk_detailTransaksi_transaksi foreign key (no_transaksi) references transaksi(no_transaksi) on delete cascade on delete cascade,
--     no_rekening int(30) not null,
--     constraint foreign key (no_rekening) references nasabah(no_rekening) on delete cascade on update cascade,
--     jenis_transaksi enum('S','T') not null,
--     jml_transaksi int not null
-- );
-- SELECT * FROM nasabah;

-- select n.kode_tabungan,
-- n.no_rekening,
-- n.nama,
-- n.alamat_nasabah,
-- n.saldo,
-- j.kode_tabungan,
-- j.jenis_tabungan
-- from nasabah n 
-- inner join jenis_tabungan j on n.kode_tabungan = j.kode_tabungan;

--  create view v_transaksi as

--  select 
--  n.kode_tabungan,
--  n.no_rekening,
-- n.nama,
-- n.alamat_nasabah,
-- n.saldo,
-- j.kode_tabungan,
-- j.jenis_tabungan,
-- c.kode_cabang,
-- c.nama_cabang,
-- c.alamat_cabang,
-- t.no_transaksi,
-- t.tgl_transaksi,
-- t.kode_cabang,
-- d.no_transaksi,
-- d.no_rekening,
-- d.jenis_transaksi,
-- d.jml_transaksi

-- from nasabah n
-- inner join jenis_tabungan j on n.kode_tabungan = j. kode_tabungan
-- inner join detailTransaksi d on n.no_rekening = d.no_rekening
-- inner join transaksi t on d.no_transaksi = t.no_transaksi
-- inner join cabang c on t.kode_cabang = c.kode_cabang;

-- select * from v_transaksi
-- where jml_transaksi <500;

-- select *from v_transaksi where jml_transaksi > 500;

-- select * from v_transaksi where jml_transaksi > 500 and nama LIKE 'F%';

-- select no_transaksi,
-- nama,
-- tgl_transaksi,
-- SUM(jml_transaksi)as total_nominal
-- from v_transaksigroup by no_transaksi,
-- nama,
-- tgl_transaksi;

-- delete from transaksi 
-- where kode_transaksi = 15;

-- delete from detailTransaksi
-- where kode_transaksi = 16;

-- CREATE TRIGGER trg_UpdateSaldoNasabah
-- ON detailTransaksi
-- AFTER INSERT
-- AS
-- BEGIN
--     SET NOCOUNT ON;

--     -- Update saldo di tabel Nasabah berdasarkan data yang baru di-insert
--     UPDATE n
--     SET n.saldo = CASE 
--         WHEN i.jenis_transaksi = 'S' THEN n.saldo + i.jml_transaksi -- S = Setor (Tambah)
--         WHEN i.jenis_transaksi = 'T' THEN n.saldo - i.jml_transaksi -- T = Tarik (Kurang)
--         ELSE n.saldo
--     END
--     FROM nasabah n
--     INNER JOIN inserted i ON n.no_rekening = i.no_rekening;
-- END;

-- CREATE PROCEDURE sp_TambahTransaksiLengkap
--     @no_transaksi int,
--     @tgl_transaksi date,
--     @kode_cabang int,
--     @no_rekening int,
--     @jenis_transaksi char(1), -- 'S' atau 'T'
--     @jml_transaksi int
-- AS
-- BEGIN
--     SET NOCOUNT ON;

--     BEGIN TRY
--         BEGIN TRANSACTION;

--         -- 1. Insert ke tabel Header (transaksi)
--         INSERT INTO transaksi (no_transaksi, tgl_transaksi, kode_cabang)
--         VALUES (@no_transaksi, @tgl_transaksi, @kode_cabang);

--         -- 2. Insert ke tabel Detail (detailTransaksi)
--         INSERT INTO detailTransaksi (no_transaksi, no_rekening, jenis_transaksi, jml_transaksi)
--         VALUES (@no_transaksi, @no_rekening, @jenis_transaksi, @jml_transaksi);

--         -- Jika sampai sini tanpa error, simpan permanen
--         COMMIT TRANSACTION;
--         PRINT 'Transaksi Berhasil Disimpan dan Saldo Terupdate Otomatis!';
        
--     END TRY
--     BEGIN CATCH
--         -- Jika ada error (misal: ID duplikat atau FK error), batalkan semua
--         IF @@TRANCOUNT > 0
--             ROLLBACK TRANSACTION;

--         PRINT 'Transaksi Gagal: ' + ERROR_MESSAGE();
--     END CATCH
-- END;
-- GO

-- -- Format: EXEC nama_proc @no_tran, @tgl, @cabang, @norek, @jenis, @jumlah
-- EXEC sp_TambahTransaksiLengkap 
--     @no_transaksi = 101, 
--     @tgl_transaksi = '2026-01-31', 
--     @kode_cabang = 1, 
--     @no_rekening = 302011, 
--     @jenis_transaksi = 'S', 
--     @jml_transaksi = 500000;


-- Buat Database Baru
CREATE DATABASE bank;
GO
USE bank;
GO

-- 1. Tabel Cabang
CREATE TABLE cabang(
    kode_cabang int PRIMARY KEY NOT NULL,
    nama_cabang varchar(50) NOT NULL,
    alamat_cabang text NOT NULL,
    created_at datetime DEFAULT GETDATE(),
    updated_at datetime NULL
);

-- 2. Tabel Nasabah
CREATE TABLE nasabah(
    kode_tabungan int PRIMARY KEY NOT NULL,
    no_rekening int NOT NULL UNIQUE, -- Unique agar bisa jadi referensi FK
    nama varchar(100) NOT NULL,
    alamat_nasabah text NOT NULL,
    saldo int NOT NULL DEFAULT 0
);

-- 3. Tabel Jenis Tabungan
CREATE TABLE jenis_tabungan(
    kode_tabungan int NOT NULL,
    jenis_tabungan varchar(50) NOT NULL,
    CONSTRAINT fk_jenis_tabungan_nasabah FOREIGN KEY (kode_tabungan) 
        REFERENCES nasabah(kode_tabungan) ON DELETE CASCADE ON UPDATE CASCADE
);

-- 4. Tabel Transaksi (Header)
CREATE TABLE transaksi(
    no_transaksi int PRIMARY KEY NOT NULL,
    tgl_transaksi date NOT NULL,
    kode_cabang int NOT NULL,
    CONSTRAINT fk_transaksi_cabang FOREIGN KEY (kode_cabang) 
        REFERENCES cabang (kode_cabang) ON DELETE CASCADE
);

-- 5. Tabel Detail Transaksi
CREATE TABLE detailTransaksi(
    no_transaksi int NOT NULL,
    no_rekening int NOT NULL,
    jenis_transaksi char(1) CHECK (jenis_transaksi IN ('S', 'T')), -- S=Setor, T=Tarik
    jml_transaksi int NOT NULL,
    CONSTRAINT fk_detailTransaksi_transaksi FOREIGN KEY (no_transaksi) 
        REFERENCES transaksi(no_transaksi) ON DELETE CASCADE,
    CONSTRAINT fk_detailTransaksi_nasabah FOREIGN KEY (no_rekening) 
        REFERENCES nasabah(no_rekening) ON DELETE CASCADE
);
GO

-- 6. View untuk Laporan Lengkap
CREATE VIEW v_transaksi AS
SELECT 
    n.nama,
    n.no_rekening,
    j.jenis_tabungan,
    c.nama_cabang,
    t.no_transaksi,
    t.tgl_transaksi,
    d.jenis_transaksi,
    d.jml_transaksi
FROM nasabah n
INNER JOIN jenis_tabungan j ON n.kode_tabungan = j.kode_tabungan
INNER JOIN detailTransaksi d ON n.no_rekening = d.no_rekening
INNER JOIN transaksi t ON d.no_transaksi = t.no_transaksi
INNER JOIN cabang c ON t.kode_cabang = c.kode_cabang;
GO

-- 7. Trigger Otomatis Update Saldo
CREATE TRIGGER trg_UpdateSaldoNasabah
ON detailTransaksi
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;
    UPDATE n
    SET n.saldo = CASE 
        WHEN i.jenis_transaksi = 'S' THEN n.saldo + i.jml_transaksi
        WHEN i.jenis_transaksi = 'T' THEN n.saldo - i.jml_transaksi
        ELSE n.saldo
    END
    FROM nasabah n
    INNER JOIN inserted i ON n.no_rekening = i.no_rekening;
END;
GO

-- 8. Stored Procedure untuk Input Transaksi Sekaligus
CREATE PROCEDURE sp_TambahTransaksiLengkap
    @no_transaksi int,
    @tgl_transaksi date,
    @kode_cabang int,
    @no_rekening int,
    @jenis_transaksi char(1),
    @jml_transaksi int
AS
BEGIN
    SET NOCOUNT ON;
    BEGIN TRY
        BEGIN TRANSACTION;
        
        -- Input ke Header
        INSERT INTO transaksi (no_transaksi, tgl_transaksi, kode_cabang)
        VALUES (@no_transaksi, @tgl_transaksi, @kode_cabang);

        -- Input ke Detail (Memicu Trigger Saldo)
        INSERT INTO detailTransaksi (no_transaksi, no_rekening, jenis_transaksi, jml_transaksi)
        VALUES (@no_transaksi, @no_rekening, @jenis_transaksi, @jml_transaksi);

        COMMIT TRANSACTION;
        PRINT 'Transaksi Sukses!';
    END TRY
    BEGIN CATCH
        IF @@TRANCOUNT > 0 ROLLBACK TRANSACTION;
        PRINT 'Error: ' + ERROR_MESSAGE();
    END CATCH
END;
GO

-- A. Isi Data Awal
INSERT INTO cabang VALUES (1, 'Cabang Karawang', 'Jl. Bypass', GETDATE(), NULL);
INSERT INTO nasabah VALUES (101, 302011, 'Farhan', 'Telukjambe', 1000000);
INSERT INTO jenis_tabungan VALUES (101, 'Tabungan Bisnis');

-- B. Jalankan Stored Procedure (Setor 500rb)
EXEC sp_TambahTransaksiLengkap 501, '2026-01-31', 1, 302011, 'S', 500000;

-- C. Lihat Hasil di View
SELECT * FROM v_transaksi;

-- D. Lihat Saldo Akhir (Harusnya jadi 1.500.000)
SELECT nama, saldo FROM nasabah WHERE no_rekening = 302011;

-- E. Contoh Group By berdasarkan View
SELECT no_transaksi, nama, SUM(jml_transaksi) as total
FROM v_transaksi 
GROUP BY no_transaksi, nama;

