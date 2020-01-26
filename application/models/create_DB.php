<?php 

class Create_db extends CI_Model {
	public function __construct() {
		$this->load->dbutil();
	}

	public function createDB() {
		if( ! $this->dbutil->database_exists( 'shop_software' ) ) {
			$this->db->query( 'CREATE DATABASE shop_software' );
			
			$this->db->query( 'USE shop_software' );
			
			$this->db->query( 'CREATE TABLE sold_items(
				ID INT AUTO_INCREMENT PRIMARY KEY,
				product VARCHAR(2000) NOT NULL,
				qty VARCHAR(2000) NOT NULL,
				price VARCHAR(2000) NOT NULL,
				parent_product VARCHAR(2000) NOT NULL,
				date_time VARCHAR(2000) NOT NULL ,
				created_date VARCHAR(2000) NOT NULL 
			)' );

			$this->db->query( 'CREATE TABLE inventory(
				ID INT AUTO_INCREMENT PRIMARY KEY,
				product VARCHAR(2000) NOT NULL,
				qty VARCHAR(2000) NOT NULL,
				add_date VARCHAR(2000) NOT NULL
			)' );

			$this->db->query( 'CREATE TABLE regular_sale(
				ID INT AUTO_INCREMENT PRIMARY KEY,
				sale_date VARCHAR(2000) NOT NULL,
				sale_amount VARCHAR(2000) NOT NULL
			)' );

		} else {
			$this->db->query( 'USE shop_software' );
		}
	}
}