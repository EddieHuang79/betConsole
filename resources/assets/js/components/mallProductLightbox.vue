<template>
    <div class="lightbox mall_product_lightbox">
        <form method="POST" action="/shop_buy_process" id="ShopForm">
            <label class="close_btn" @click="ClosePopup"> X </label>
            <div class="mall_product_name">{{ data.mallProductName }}</div>
            <hr />
            <div class="mall_child_product">
                {{ txt.include_service }}
                <div v-for="item in data.includeService"> {{ item.productName }} X {{ item.number }} 可用 {{ item.dateSpec }} 天 </div>
            </div>
            <div class="mall_product_option">
                <div class="mall_product_spec">
                    <div> {{ txt.cost_unit }} <label class="cost" :class="data.costClass"> {{ data.cost }} </label>  </div>
                    <div class="promo_price" v-if="data.promo > 0"> {{ txt.promo_price }} {{ txt.cost_unit }} <label class="promo_price"> {{ data.promo }} </label>  </div>
                </div>
                <div class="mall_product_number">
                    <div class="number_btn minus" @click="minusNumber">-</div> <div><input type="text" name="mall_product_number" :value="defaultNumber" size="1" style="width: 30px; text-align: center;" readonly="true"></div> <div class="number_btn plus" @click="addNumber">+</div>
                </div>
            </div>
            <div style="width: 85%; margin: 0px auto;" v-if="data.ecouponList.length > 0">
                <select class="form-control" name="Ecoupon" @change="getEcouponDiscount($event)">
                    <option value="">{{ txt.ecoupon_select_default }}</option>
                    <option v-for="item in data.ecouponList" :value="item.code">{{ item.name }}</option>
                </select>
            </div>
            <div class="mall_product_cost">
                <div>{{ txt.sub_total }} NT. {{ data.subTotal }}</div>
                <div v-if="data.ecouponMinus < 0">{{ txt.ecoupon_discount }} NT. {{ data.ecouponMinus }}</div>
                <div>{{ txt.total }} NT. {{ data.total }}</div>
            </div>
            <div class="mall_product_btn">
                <input type="hidden" class="mall_shop_id" name="mall_shop_id" :value="data.mallShopId">
                <input type="hidden" name="total" :value="data.total">
                <input type="submit" :value="txt.buy" class="btn btn-primary">
                <input type="button" :value="txt.back" class="btn btn-primary" @click="ClosePopup">
                <input type="hidden" name="_token" :value="token">
            </div>
        </form>
    </div>
</template>

<script>
    module.exports = {

        data: function() {
            return {
                data: {
                    mallShopId: 0,
                    mallProductName: "",
                    cost: "",
                    promo: 0,
                    subTotal: 0,
                    ecouponMinus: 0,
                    total: 0,
                    includeService: [],
                    costClass: "",
                    ecouponList: []
                },
                defaultNumber: 1
            }
        },
        props: ["txt", "token"],
        methods: {

            ClosePopup: function(){

                $(".lightbox").hide();
                
                this.data = {
                    mallShopId: 0,
                    mallProductName: "",
                    cost: "",
                    promo: 0,
                    subTotal: "",
                    includeService: [],
                    costClass: ""
                };

            },

            minusNumber: function(){

                var ori_value = this.defaultNumber,
                    new_value = parseInt(ori_value) > 1 ? parseInt(ori_value) - 1 : parseInt(ori_value);

                    this.defaultNumber = new_value;

                    this.getEcouponDiscount();

                    this.shop_calc();

            },

            addNumber: function(){

                var ori_value = this.defaultNumber,
                    new_value = parseInt(ori_value) + 1;

                    this.defaultNumber = new_value;

                    this.getEcouponDiscount();

                    this.shop_calc();

            },


            shop_calc: function(){

                var number = this.defaultNumber,
                    promo = this.data.promo,
                    price = promo > 0 ? promo : this.data.cost,
                    total = number * price,
                    total_price = isNaN(total) ? 0 : total,
                    ecouponMinus = this.data.ecouponMinus;

                    this.data.subTotal = total_price;

                    this.data.total = total_price + ecouponMinus;
            
            },

            getEcouponDiscount: function(){

                var code = $("[name='Ecoupon']").val();

                $.ajax({
                    url: "/getEcouponDiscount",
                    data: "code="+code+"&sub_total="+this.data.subTotal,
                    type: 'POST',
                    success: function( response ) {
                        
                        var result = JSON.parse(response),
                            subTotal = shopList.$refs.mallProductLightbox.data.subTotal,
                            ecouponMinus = parseInt(result.discount_price),
                            total = subTotal + ecouponMinus;

                        shopList.$refs.mallProductLightbox.data.ecouponMinus = ecouponMinus;
                        shopList.$refs.mallProductLightbox.data.total = total;

                    }
                });

            }

        }

    }
</script>
