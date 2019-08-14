<template>
    <div>

        <quiz-start v-if="currentStep === 1"
                    :name="name"
                    :quizzes="quizzes"
                    @quiz-started="onQuizStarted">
        </quiz-start>

        <quiz-questions :current-question="currentQuestion" v-else-if="currentStep === 2">
        </quiz-questions>

        <quiz-results v-else-if="currentStep === 3">
        </quiz-results>

        <div v-else class="container" style="height:70vh;">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12">
                    <div class="card border-light">
                        <div class="card-body text-center">
                            <button class="btn btn-danger" @click="currentStep = 1">
                                Something went wrong. Return to start.
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import QuizStartComponent from './quiz-start.vue';
    import QuizQuestionsComponent from './quiz-questions.vue';
    import QuizResultsComponent from './quiz-results.vue';
    import {Quiz} from './../models/quiz.models.js';

    export default {
        components: {
            'quiz-start': QuizStartComponent,
            'quiz-questions': QuizQuestionsComponent,
            'quiz-results': QuizResultsComponent
        },

        props: {
            name: {
                required: true,
            },

            quizzesProp: {
                default: [],
                required: true,
            }
        },

        created() {
            this.quizzes = this.quizzesProp.map((quizDatum) => {
                return Quiz.fromArray(quizDatum);
            })
        },

        data() {
            return {
                /** @type {Array<Quiz>} */
                quizzes: [],

                /** @type {Number} **/
                currentStep: 1,

                /** @type {?Number} */
                currentQuizId: null,

                /** @type {?Number} */
                currentQuestion: null,
            }
        },

        methods: {
            /**
             * @param {{quizId: number, firstQuestion Question}} emittedData
             */
            onQuizStarted(emittedData) {
                this.currentQuizId = emittedData.quizId;
                this.currentQuestion = emittedData.firstQuestion;

                this.currentStep++;
            }
        }
    }
</script>