<template>
    <form action="/subscriptions" method="POST">
        <input type="hidden" v-model="stripeToken" class="stripeToken">
        <input type="hidden" v-model="stripeEmail" class="stripeEmail">

        <select name="plan" v-model="plan">
            <option v-for="plan in plans" :value="plan.id">
                {{ plan.name }} &mdash; ${{plan.price/100}}
            </option>
        </select>

        <button class="submit" @click.prevent="subscribe">Subscribe</button>
    </form>

    <p class="danger" v-show="status" v-text=""status></p>
</template>

<script>
    export default {
        props: ['plans'],
        data() {
            return {
                'stripeEmail': '',
                'stripeToken': '',
                'plan': '1',
                'status': false
            }
        },
        created() {
            this.stripe = StripeCheckout.configure({
                key: Laracasts.stripeKey,
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
                panelLabel: "Subscribe For",
                token: token => {
                    this.stripeEmail = token.email;
                    this.stripeToken = token.id;

                    axios.post('/subscriptions', this.$data)
                        .then(response => this.status = response.body.status);
                }
            });
        },
        methods: {
            subscribe() {
                let plan = this.findPlanById(this.plan);
                    this.stripe.open({
                    name: plan.name,
                    description: plan.description,
                    zipCode: true,
                    amount: plan.price

                });
            },

            findPlanById(id) {
                return this.plans.find(plan => plan.id == id);
            }
        }
    }
</script>
