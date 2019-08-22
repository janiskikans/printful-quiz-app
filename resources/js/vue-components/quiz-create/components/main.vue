<template>
    <div>

        <div v-if="currentStep === 1">
            <quiz-create-title></quiz-create-title>
        </div>

        <div v-else class="container" style="height:70vh;">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-6">
                    <button class="btn btn-danger" @click="currentStep = 1">
                        Something went wrong. Return to start.
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import QuizCreateTitle from "./quiz-create-title.vue";

    export default {
        components: {
            'quiz-create-title': QuizCreateTitle,
        },

        data() {
            return {
                /** @type {Number} **/
                currentStep: 1,
            }
        }
    }
</script>