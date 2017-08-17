<template>
    <form action="/purchases" method="POST">
        <input type="hidden" v-model="stripeToken" class="stripeToken">
        <input type="hidden" v-model="stripeEmail" class="stripeEmail">

        <button class="submit" @click.prevent="buy">Buy</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                'stripeEmail': '',
                'stripeToken': ''
            }
        },
        created() {
            this.stripe = StripeCheckout.configure({
                key: Laracasts.stripeKey,
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
                token: token => {
                    this.stripeEmail = token.email;
                    this.stripeToken = token.id;

                    this.axios.post('/purchases', this.$data)
                        .then(responce => alert('Complete'));
                }
            });
        },
        methods: {
            buy() {
                    this.stripe.open = ({
                    name: "My Book",
                    discription: "Some book",
                    zipCode: true,
                    amount: 2500

                });
            }
        }
    }
</script>
