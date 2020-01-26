<?php

class Prev_sales extends CI_Model {

	public function __construct() {
		$this->load->model( 'inventory' );
	}

	/**
	 * Get sales amount by date range
	 */
	public function get_sales_amount_by_range( $date1, $date2 ) {
		$query = $this->db->query( 'SELECT * FROM regular_sale WHERE sale_date >= "'.$date1.'" AND sale_date <= "'.$date2.'"' );

		$price = 0;
		if( $query->num_rows() > 0 ) {
			foreach( $query->result() as $sale ) {
				$price += $sale->sale_amount;
			}	
		}
		
		return $price;
	}

	/**
	 * Remove prev sales by range
	 */
	public function remove_sales_by_range( $ids, $date ) {
		$this->db->where_in( 'id', $ids );
		$this->db->delete( 'sold_items' );

		$this->db->query( 'DELETE FROM regular_sale WHERE sale_date BETWEEN "'.$date['f_date'].'" AND "'.$date['t_date'].'"' );
	}

	/**
	 * Total pages of sold items
	 */
	public function prev_sales_pages() {	
		$items = $this->db->get( 'sold_items' );
		$per_page = 10;
		return ceil( $items->num_rows() / $per_page );
	}

	/**
	 * Get paginated results for sold items
	 */
	public function paginated_prev_sales( $offset ) {
		$per_page = 10;
		$this->db->limit( $per_page, ( $offset - 1 ) * $per_page );
		$this->db->order_by( 'ID', 'DESC' );
		return $this->db->get( 'sold_items' );
	}

	/**
	 * Get pages for search results
	 */
	public function prev_sales_date_filter_page( $date ) {
		$query = $this->db->query( 'SELECT * FROM sold_items WHERE created_date >= "'.$date['f_date'].'" AND created_date <= "'.$date['t_date'].'"' );
		$per_page = 10;

		return ceil( $query->num_rows() / $per_page );
	}

	/**
	 * Get paginated search results prev sales
	 */
	public function get_sales_by_date_filter( $date, $page ) {
		$per_page = 10;
		$page = ( $page - 1 ) * $per_page;
		$query = $this->db->query( 'SELECT * FROM sold_items WHERE created_date >= "'.$date['f_date'].'" AND created_date <= "'.$date['t_date'].'" LIMIT '.$per_page.' OFFSET '.$page );

		return $query;
	}
}