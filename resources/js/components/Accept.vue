<template>
    <div>
        <!-- {{-- mark the question as favorite --}} -->
        <a v-if="canAccept" title="Mark this answer as best answer" 
        :class="classes"
        @click.prevent="create">
            <!-- {{-- ganti fontawesome --}} -->
            <i class="fas fa-check fa-2x"></i>
        </a>

        <!-- {{-- mark the question as favorite --}} -->
        <a v-if="accepted" title="The question owner accepted this answer as best answer" 
        :class="classes">
            <!-- {{-- ganti fontawesome --}} -->
            <i class="fas fa-check fa-2x"></i>
        </a>
    </div>
</template>

<script>
export default {
    props: ['answer'],
    
    data () {
       return {
           isBest: this.answer.is_best,
        //    id prop to hold answer id
            id: this.answer.id
       }
    },

    methods: {
        create () {
            // make ajax post request
            axios.post(`/answers/${this.id}/accept`)
            .then(res => {
                this.$toast.success(res.data.message, "Success", {
                    timeout: 3000,
                    position: 'bottomLeft'
                });

                // change isBest to true
                this.isBest = true;
            })
        }
    },

    computed: {
        // auth logic, temporary
        canAccept () {
            return this.authorize('accept', this.answer);
        },

        accepted() {
            return !this.canAccept && this.isBest;
        },

        classes () {
            return [
                'mt-2',
                 this.isBest ? 'vote-accepted' : ''
                ];
        }
    }
}
</script>