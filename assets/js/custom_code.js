( function( $ ) { 'use strict';
	$( document ).ready( function() {
		var soft = {
			init: function() {
				this.getSavedProducts();
				this.showMultiDeleteIcon();
				this.removeMultiRows();
				this.editInventoryRow();
				this.updateInventoryRows();
				this.dismissNotice();
				this.initializeDatepicker();
			},

			initializeDatepicker: function() {
				if( $( '.prev-sale-date' ).length > 0 ) {
					$( '.prev-sale-date' ).datepicker({
						dateFormat: 'yy-mm-dd'
					});
				} 
			},

			dismissNotice: function() {
				if( $( '.dismiss-notice' ).length > 0 ) {
					$( '.dismiss-notice' ).on( 'click', function() {
						var url = location.href.split( '?' ).shift();
						window.location.href = url;
					});
				}  
			},

			updateInventoryRows: function() {
				if( $( '.update-inventory-rows' ).length > 0 ) {

					if( $._data( $( '.update-inventory-rows' ), 'events' ) !== undefined ) {
						return;
					}

					$( '.update-inventory-rows' ).on( 'click', function( e ) {
						e.preventDefault();

						var prds = [],
							qty = [],
							price = [],
							ids = [];

						$.each( $( '.edit-prd-val' ), function( index, prd ) {
							prds.push( $( prd ).val() );
							qty.push( $( '.edit-prd-qty' )[index].value );
							if( pagenow == 'dashboard' ) {
								price.push( $( '.edit-prd-price' )[index].value );	
							}
							ids.push( $( '.edit-prd-id' )[index].value );
						});
						
						var data = {
							prds: prds,
							qty: qty,
							price: price,
							ids: ids
						};

						var ajax_func = pagenow == 'dashboard' ? 'update_sold_items': 'update_multi_inventory';

						$.post( ajaxURL + ajax_func , data, function( resp ) {
							alert( 'Data Updated.' );
							location.reload();
						});
					});
				}
			},

			editInventoryRow: function() {
				if( $( '.edit-btn-inventory' ).length > 0 ) {
					$( '.edit-btn-inventory' ).on( 'click', function() {
						var cols_prds = $( this ).parents( '.inventory-tab-row' ).find( '.editable-col-prd' ),
							cols_qty = $( this ).parents( '.inventory-tab-row' ).find( '.editable-col-qty' ),
							cols_price = $( this ).parents( '.inventory-tab-row' ).find( '.editable-col-price' ),
							id = $( this ).data( 'id' );

						$( '.update-inventory-rows' ).css( 'display', 'initial' );   

						$.each( cols_prds, function( index, td ) {
							var val = $( td ).html(); 
							$( td ).html( '<input type="text" class="edit-prd-val form-control" value="'+val+'" />'+
								'<input type="hidden" class="edit-prd-id" value="'+id+'" />' 
							);
							if( pagenow == 'dashboard' ) {
								var price_now = cols_price[index].innerHTML;
								cols_price[index].innerHTML = '<input type="text" class="edit-prd-price form-control" value="'+price_now+'" />';
							}
						});
						$.each( cols_qty, function( index, td ) {
							var val = $( td ).html(); 
							$( td ).html( '<input type="text" class="edit-prd-qty form-control" value="'+val+'" />' );
						});

						$( this ).css( 'display', 'none' );
					});
				}
			},

			removeMultiRows: function() {
				if( $( '.remove-multi-rows' ).length > 0 ) {
					$( '.remove-multi-rows' ).on( 'click', function() {
						var ids = [];
						$.each( $( '.inv-entry-checkbox' ), function( index, checkbox ) {
							if( $( checkbox ).prop( 'checked' ) ) {
								ids.push( $( checkbox ).val() );
							}
						});
						if( ids.length > 0 ) {
							
							var ajax_func = pagenow == 'dashboard' ? 'remove_multi_sold_items': 'remove_multi_inventory';
							jQuery.post( ajaxURL + ajax_func, { ids: ids }, function( resp ) {
								window.location.reload();
							});
						}
					});
				}
			},

			getSavedProducts: function() {
				if( $( '.sold-item' ).length > 0 ) {
					$( '.sold-item' ).on( 'keyup', function() {
						var data = {
							queryString: $( this ).val()
						},
						url = ajaxURL + 'get_inventory_products';
						
						if( data.queryString.length > 2 ) {
							jQuery.post( url, data, function( resp ) {
								$( '.search-list' ).html( resp );
								$( '.search-list-title' ).css( 'display', 'block' );

								if( $( '.active-prds' ).length > 0 && $._data( $( '.active-prds' ), 'events' ) === undefined ) {
									$( '.active-prds' ).on( 'click', function( e ) {
										$( '.sold-item' ).val( $( this ).html() );
										$( '.sold-item' ).attr( 'data-qty', $( this ).data( 'qty' ) );
										$( '.sold-item-hidden' ).val( $( this ).data( 'id' ) );
										$( '.search-items' ).remove();
										$( '.add-sold-item' ).removeAttr( 'disabled' );
										$( '.search-list-title' ).css( 'display', 'none' );
									});
								}
								if( $( '.sold-item-qty' ).length > 0 && $._data( $( '.sold-item-qty' ), 'events' ) === undefined ) {
									$( '.sold-item-qty' ).on( 'blur', function() {
										var qty = $( '.sold-item' ).data( 'qty' );

										if( $( this ).val() > qty ) {
											alert( 'Quantity = '+qty+' is left for this item.' );
											$( this ).val( '' );
										}
									});
								}
							});	
						}
					});
				}
			},

			showMultiDeleteIcon: function() {
				if( $( '.inv-entry-checkbox' ).length > 0 ) {
					$( '.inv-entry-checkbox' ).on( 'click', function() {
						var checked = false;
						$.each( $( '.inv-entry-checkbox' ), function( index, checkbox ) {
							if( $( checkbox ).prop( 'checked' ) ) {
								checked = true;
							}
						}); 
						
						if( checked ) {
							$( '.remove-multi-rows' ).css( 'display', 'block' );
						} else {
							$( '.remove-multi-rows' ).css( 'display', 'none' );
						}
					});
				}
			}
		}

		soft.init();
	})
})( jQuery );