<template>
   <div class="d-flex flex-wrap justify-content-end">
        <form action="" method="GET" class="form-inline">
            <div class="input-group justify-content-end">
                <Input 
                    type="text" 
                    v-model="keyword" 
                    class="form-control bg--white" 
                    placeholder="Search..." 
                    auto-complete="off"
                    @keyup="search"
                    />
                <button class="btn btn--primary input-group-text" type="submit"><font-awesome-icon icon="search"/></button>
            </div>
        </form>
    </div>
</template>

<script>
import Input from '@/Components/Input.vue';
import Helpers from '@/Mixins/Helpers'

export default {
    props: ['callType', 'searchedKeyword', 'status', 'types'],
    components: { Input },  
    data() {
        return {
            type: this.callType,
            keyword: this.searchedKeyword,
            timer: null,
            filterData : null,
        };
    },
    methods: {
        search() {
            // emitter to get keyword data for filter
            this.emitter.emit('filter-keyword', 
            {
                filterKeyword: this.keyword,
            })
            clearTimeout(this.timer);
            this.timer = setTimeout(() => {
                if(this.type == 'user_bonus'){
                    this.$inertia.get(
                    route(this.submissionUrl(this.type), {
                        keyword: this.keyword,
                        status: this.status
                    }));
                }else if(this.type == 'manual_gateway' || this.type == 'deposit'){
                    this.$inertia.get(
                    route(this.submissionUrl(this.type), [ types ], {
                        keyword: this.keyword,
                        status: this.status
                    }));
                }else{
                    this.$inertia.get(
                    route(this.submissionUrl(this.type), {
                        keyword: this.keyword,
                    }));
                }
            })
        },

        submissionUrl(type) {
            var url = "";
            switch (type) {
                case "administrators":
                    url = "administrators.index";
                    break;
                case "plans":
                    url = "manage-plan.index";
                    break;
                case 'bonus_plans':
                    url = "bonus-plans.index"
                    break;
                case 'user_bonus':
                    url = 'user-bonus.index';
                    break;
                case 'users':
                    url = 'users.index';
                    break
                case 'manual_gateway':
                    url = 'manual-gateway.index';
                    break;
                case 'deposit':
                    url = 'deposit.index';
                    break;
            }
            return url;
        },
    },
    mixins: [Helpers]
}
</script>