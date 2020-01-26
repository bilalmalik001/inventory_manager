<?php

class Inventory extends CI_Model {

	/**
	 * Add inventory
	 */
	public function add_inventory( $inv_data ) {
		$this->db->insert( 'inventory', $inv_data );
	}

	/**
	 * Update saved inventory product name/qty
	 */
	public function update_inventory_item( $prd ) {
		$this->db->set( 'product', $prd['prd'] );
		$this->db->set( 'qty', $prd['qty'] );
		$this->db->where( 'ID', $prd['id'] );
		$this->db->update( 'inventory' );
	}

	/**
	 * Get inventory for search results
	 */
	public function get_filtered_inventory_product( $product ) {
		$query = $this->db->query( 'SELECT * FROM inventory WHERE product LIKE "%'.$product.'%" LIMIT 5' );
		return $query;
	}

	/**
	 * Minus inventory after an item sold
	 */
	public function minus_inventory( $sold_item_data ) {

		$qty = $this->db->get_where( 'inventory', [ 'ID' => $sold_item_data['parent_product'] ] );

		$qty = ( int ) $qty->row()->qty - ( int ) $sold_item_data['qty'];
		
		$this->db->where( 'id', $sold_item_data['parent_product'] );
		$this->db->update( 'inventory', [ 'qty' => $qty ] );
	}

	/**
	 * Total inventory pages
	 */
	public function total_inventory_pages() {
		return ( int ) ceil( $this->db->get( 'inventory' )->num_rows() / 10 );
	}

	/**
	 * Get paginated inventory items
	 */
	public function get_paginated_inventory( $offset ) {
		$per_page = 10; 
		$this->db->limit( $per_page, ( $offset - 1 ) * $per_page );
		$this->db->order_by( 'ID', 'DESC' );
		return $this->db->get( 'inventory' );
	}

	/**
	 * Remove inventory items
	 */
	public function delete_multi_inventory_items( $ids ) {
		if( count( $ids ) > 0 ) {
			foreach( $ids as $id ) {
				$this->db->delete( 'inventory', [ 'ID' => $id ] );	
			}
		}
	}

	/**
	 * Get search inventory
	 */
	public function get_search_inventory( $product ) {
		return $this->db->query( "SELECT * FROM inventory WHERE product LIKE '%".$product."%' LIMIT 5" );
	}
}