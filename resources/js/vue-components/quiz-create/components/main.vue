<template>
    <div>

        <div v-if="currentStep === 1">
            <quiz-create-title @quiz-creation-started="onQuizCreationStarted"></quiz-create-title>
        </div>

        <div v-else-if="currentStep === 2">
            <quiz-create-questions :quiz-name="newQuizTitle"></quiz-create-questions>
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
    import QuizCreateQuestions from "./quiz-create-questions.vue"

    export default {
        components: {
            'quiz-create-title': QuizCreateTitle,
            'quiz-create-questions': QuizCreateQuestions,
        },

        data() {
            return {
                /** @type {Number} **/
                currentStep: 1,

                /** @type {Number} **/
                newQuizId: null,

                /** @type {string} **/
                newQuizTitle: '',
            }
        },

        methods: {
            /**
             * @param {{newQuizId: number, newQuizTitle: string}} emittedData
             */
            onQuizCreationStarted(emittedData) {
                this.newQuizId = emittedData.newQuizId;
                this.newQuizTitle = emittedData.newQuizTitle;

                this.currentStep++;
            }
        },
    }
</script>