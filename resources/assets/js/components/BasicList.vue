<template>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th v-for="(item, index) in list.title">
                    <div v-if="item.clickAll"><input type="checkbox" class="clickAll" @click="clickAll(item.target)"> {{ txt.select_all }}</div>
                    <div v-if="typeof item === 'string'">{{ item }}</div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item2 in list.data">
                <td v-for="row in item2.data">
                    <div v-if="!Array.isArray(row)">
                        <div v-if="row.isImage && row.data != ''"><img :src="row.data" alt="ProductPic" :class="row.class"/></div>
                        <div v-if="row.checkbox"><input type="checkbox" :name="row.key" :value="row.id" :class="row.class"/></div>
                        <div v-if="typeof row !== 'object'">{{ row }}</div>
                    </div>
                    <div v-if="Array.isArray(row)">
                        <div v-for="(row1,index) in row">
                            <div>{{ row1 }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <input v-if="item2.Editlink" type="button" class="btn btn-primary" :value="txt.edit" @click="linkTo(item2.Editlink)"/>
                    <input v-if="item2.ExtendBtn" type="button" class="btn btn-primary extend_account_deadline" :value="txt.extend_deadline" @click="extend_account_deadline( item2.id, item2.account )"/>
                    <input v-if="item2.Clonelink" type="button" class="btn btn-primary" :value="txt.clone" @click="linkTo(item2.Clonelink)"/>
                    <input v-if="item2.PromoSettinglink" type="button" class="btn btn-primary" :value="txt.promo_price_setting" @click="linkTo(item2.PromoSettinglink)"/>
                    <div v-if="item2.actionWord">{{ item2.actionWord }}</div>
                </td>
            </tr>
            <tr v-if="list.data.length < 1">
                <th :colspan="list.title.length + 1">{{ txt.find_nothing }}</th>
            </tr>
        </tbody>
    </table>
</template>

<script>
    module.exports = {

        props: ["txt", "list"],
        methods: {

            linkTo: function(link){

                location.href = link;

            },

            extend_account_deadline: function(id, account){
                
                $(".popup_option").find(".account").text(account);
                $("[name='user_id']").val(id);

                $.ajax({
                    url: "/get_extend_deadline_option",
                    type: 'POST',
                    success: function( response ) {

                        var data = JSON.parse(response);

                        if ( data.length !== 0 ) 
                        {

                            $('[name="date_spec"]>.append').remove();

                            $.map(data, function(value, index) {
                                $('[name="date_spec"]').append($('<option>', {
                                    value: index,
                                    text: value,
                                    class: "append"
                                }));
                            });

                        }
                        else
                        {

                            $("div.popup_option").text("擴充道具不足，請前往商城購買！");
                            $("div.mall_product_btn").text("");
                            $("div.mall_product_btn").append("<button class=\"btn btn-lg btn-primary btn-block\" type=\"button\" onclick=\"location.href='/buy';\">前往商城購買</button>");

                        }

                        $(".extend_lightbox").show();
                    
                    }
                }); 

            },

            clickAll: function(target){

                $("."+target).prop("checked", $(".clickAll").prop("checked"));

            }

        }

    }
</script>
