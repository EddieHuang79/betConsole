<template>
    <div>
        <div class="mall_product" v-for="item in list" @click="callLightBox(item.id)">
            <img :src="item.pic" :alt="item.product_name" :MallProductId="item.id">
        </div>
        <div class="mall_product" v-if="list.length < 1">{{ txt.find_nothing }}</div>
    </div>
</template>

<script>
    module.exports = {

        props: ["txt", "list"],
        methods: {

            callLightBox: function(id){

                var mall_product_lightbox_width = ( $(".mall_product_lightbox").width() / 2 ) * -1;
                
                $(".mall_product_lightbox").css( "margin-left", mall_product_lightbox_width );

                $(".mall_child_product").find("div").remove();

                $.ajax({
                    url: "/get_mall_product",
                    data: "mall_product_id="+id,
                    type: 'POST',
                    success: function( response ) {
                        var data = JSON.parse(response),
                            total = parseInt(data.promo) > 0 ? parseInt(data.promo) * 1 : parseInt(data.cost) * 1,
                            scope = {
                                        mallProductName: data.mall_product_name,
                                        cost: parseInt(data.cost),
                                        promo: parseInt(data.promo),
                                        subTotal: total,
                                        ecouponMinus: 0,
                                        total: total,
                                        mallShopId: data.mall_shop_id,
                                        includeService: [],
                                        costClass: parseInt(data.promo) > 0 ? "line-through" : "",
                                        ecouponList: data.ecoupon_list
                                    };

                            $.map(data.include_service, function(row) {
        
                                scope.includeService[ scope.includeService.length ] = {
                                    productName: row['product_name'],
                                    number: row['number'],
                                    dateSpec: row['date_spec']
                                }

                            });

                            shopList.$refs.mallProductLightbox.data = scope ;

                            $(".mall_product_lightbox").fadeIn(200);

                    }
                });

            }

        }

    }
</script>
