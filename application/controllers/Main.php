<?php

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model( 'create_db' );
		$this->load->model( 'inventory' );
		$this->load->model( 'sold_items' );
		$this->load->model( 'prev_sales' );
		$this->create_db->createDB();

		date_default_timezone_set( 'Asia/Karachi' );
	}

	public function ajaxURL() { 
		$page = $this->uri->segment(2) == '' ? 'dashboard' : $this->uri->segment(2);
	?>
		<script>
	        var ajaxURL = '<?php echo base_url().'main/'; ?>';
	        var pagenow = '<?php echo $page; ?>';
	    </script>
	<?php
	}

	public function index() {
		$args = array(
			'main' =>  $this,
			'sold_items' => $this->sold_items
		);
		$this->ajaxURL();

		if( isset( $_POST['add_sold_item'] ) ) {
			$sold_item_data = array(
				'product' 	=> isset( $_POST['sold_item'] ) ? $_POST['sold_item'] : '',
				'qty'		=> isset( $_POST['sold_item_qty'] ) ? $_POST['sold_item_qty'] : '',
				'price'		=> isset( $_POST['sold_item_price'] ) ? $_POST['sold_item_price'] : '',
				'parent_product' => isset( $_POST['sold_item_id'] ) ? $_POST['sold_item_id'] : '',
				'date_time'=> date( 'Y-m-d h:i A' ),
				'created_date' => date( 'Y-m-d' )
			);
			$this->sold_items->add_sold_item( $sold_item_data );
			$this->sold_items->save_regular_sale( $sold_item_data );
			$this->inventory->minus_inventory( $sold_item_data );
			redirect( base_url() . 'main' );
		}
		$this->load->view( 'dashboard', $args );
	}

	public function previous_sale() {
		$args = array(
			'main' =>  $this,
			'prev_sales' => $this->prev_sales
		);

		if( isset( $_POST['remove_prev_sales'] ) ) {
			$this->prev_sales->remove_sales_by_range( $_POST['remove_prev_sales'], [ 'f_date' => $_POST['prev_sale_date1'], 't_date' => $_POST['prev_sale_date2'] ] );
		}

		$this->ajaxURL();
		$this->load->view( 'prev_sale', $args );
	}

	public function add_inventory_page() {
		$args = array(
			'main' =>  $this,
			'inv_model' => $this->inventory
		);
		$this->ajaxURL();
		$this->load->view( 'add_inventory', $args );

		if( isset( $_POST['add_inv'] ) ) {
			$add_inv_data = array(
				'product' 		=> isset( $_POST['inv_product_name'] ) ? $_POST['inv_product_name'] : '',
				'qty'			=> isset( $_POST['inv_product_qty'] ) ? $_POST['inv_product_qty'] : '',
				'add_date'		=> time()
			);
			$this->inventory->add_inventory( $add_inv_data );
			redirect( base_url() . 'main/add_inventory_page/?msg=added' );
		}
	}

	public function get_inventory_products() {
		$products = $this->inventory->get_filtered_inventory_product( $_POST['queryString'] );
		if( $products->num_rows() > 0 ) {
			foreach( $products->result() as $product ) { 
				$no_qty = $product->qty > 0 ? 'active-prds ' : 'no-stock';
				$no_qty_msg = $no_qty == 'no-stock' ? ' - No stock left' : '';
			?>
				<li class="<?php echo $no_qty; ?> search-items" data-id="<?php echo $product->ID; ?>" data-qty="<?php echo $product->qty; ?>"><?php echo $product->product . $no_qty_msg; ?></li>
			<?php
			}	
		} else { ?>
			<li>No product found.</li>
		<?php
		}
	}

	public function remove_multi_inventory() {
		$this->inventory->delete_multi_inventory_items( $_POST['ids'] );
	}

	public function remove_multi_sold_items() {
		$this->sold_items->delete_multi_sold_items( $_POST['ids'] );
	}

	public function success_notice() {
	?>
		<div class="alert alert-success">
			Inventory Updated.
			<span class="dismiss-notice">x</span>
		</div>
	<?php
	}

	/**
	 * Update saved inventory product name/qty
	 */
	public function update_multi_inventory() {
		if( isset( $_POST ) ) {
			foreach( $_POST['prds'] as $k => $prd ) {
				$prd_arr = array(
					'prd' => $prd,
					'qty' => $_POST['qty'][$k],
					'id' => $_POST['ids'][$k]
				);
				$this->inventory->update_inventory_item( $prd_arr );
			}
		}
	}

	/**
	 * Update sold item product name/qty
	 */
	public function update_sold_items() {
		if( isset( $_POST ) ) {
			foreach( $_POST['prds'] as $k => $prd ) {
				$prd_arr = array(
					'prd' => $prd,
					'qty' => $_POST['qty'][$k],
					'price' => $_POST['price'][$k],
					'id' => $_POST['ids'][$k]
				);
				$this->sold_items->update_inventory_item( $prd_arr );
			}
		}
	}
}
