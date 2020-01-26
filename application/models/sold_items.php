<?php

class Sold_items extends CI_Model {

	/**
	 * Save regular sale amount 
	 */
	public function save_regular_sale( $prd ) {
		$this->db->where( 'sale_date', $prd['created_date'] );
		$rows = $this->db->get( 'regular_sale' )->num_rows();

		if( $rows > 0 ) {
			$amount = ( int ) $this->db->get( 'regular_sale' )->result()[0]->sale_amount;
			$this->db->where( 'sale_date', $prd['created_date'] );
			$this->db->set( 'sale_amount', ( $amount + $prd['price']) );
			$this->db->update( 'regular_sale' );
		} else {
			$data = array(
				'sale_date' => $prd['created_date'], 
				'sale_amount' => $prd['price']
			);
			$this->db->insert( 'regular_sale', $data );
		}
	}

	public function add_sold_item( $sold_item_data ) {
		$this->db->insert( 'sold_items', $sold_item_data );
	}

	public function sold_items_specific( $prd ) {
		$this->db->like( 'product', $prd );
		$this->db->like( 'date_time', date( 'Y-m-d' ) );
		$items = $this->db->get( 'sold_items' );
		
		return $items;
	}

	/**
	 * Get sold items of current date
	 */
	public function get_sold_items_today() {
		$this->db->like( 'date_time', date( 'Y-m-d' ) );
		return $this->db->get( 'sold_items' );
	}

	public function get_last_item_sold_today() {
		$this->db->like( 'date_time', date( 'Y-m-d' ) );
		$this->db->order_by( 'ID', 'DESC' );
		$this->db->limit( '1' );
		return $this->db->get( 'sold_items' )->num_rows() > 0 ? date( 'h:i A', strtotime( $this->db->get( 'sold_items' )->result()[0]->date_time ) ) : 'No sale today' ;
	}

	/**
	 * Get sold items of current date
	 */
	public function get_sold_items_qty_today() {
		$this->db->like( 'date_time', date( 'Y-m-d' ) );
		$items = $this->db->get( 'sold_items' );

		$qty = 0;
		if( $items->num_rows() > 0 ) {
			foreach( $items->result() as $item ) {
				$qty += ( int ) $item->qty;	
			}
		}
		return $qty;
	}

	/**
	 * Most sold item of today
	 */
	public function get_most_sold_item_today() {
		$this->db->like( 'date_time', date( 'Y-m-d' ) );
		$items = $this->db->get( 'sold_items' );

		$products = [];
		if( $items->num_rows() > 0 ) {
			foreach( $items->result() as $item ) {
				$products[] = $item->product;	
			}
		} else {
			return 0;
		}

		$filtered_products = array_unique( $products );
		$filtered_products = array_values( $filtered_products );
		
		$most_occur = [];

		foreach( $filtered_products as $val ) {
			$most_occur[] = 0;
		}

		foreach( $products as $v ) {
			if( array_search( $v, $filtered_products ) !== false ) {
				$most_occur[array_search( $v, $filtered_products )] += 1;
			}
		}

		return ucwords( $filtered_products[array_search( max( $most_occur ), $most_occur )] );
	}

	/**
	 * Remove sold items
	 */
	public function delete_multi_sold_items( $ids ) {
		if( count( $ids ) > 0 ) {
			foreach( $ids as $id ) {
				$this->db->delete( 'sold_items', [ 'ID' => $id ] );	
			}
		}
	}

	/**
	 * Get amount of today's sold items
	 */
	public function total_amount_today_sold_items() {
		
		$this->db->like( 'date_time', date( 'Y-m-d' ) );
		$items = $this->db->get( 'sold_items' );
		
		$amount = 0;
		foreach( $items->result() as $key => $item ) {
			$amount += ( int ) $item->price;
		}
		return $amount;
	}

	/**
	 * Update saved sold item product name/qty
	 */
	public function update_inventory_item( $prd ) {
		$this->db->set( 'product', $prd['prd'] );
		$this->db->set( 'qty', $prd['qty'] );
		$this->db->set( 'price', $prd['price'] );
		$this->db->where( 'ID', $prd['id'] );
		$this->db->update( 'sold_items' );
	}
}