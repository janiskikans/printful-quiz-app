<template>

    <div class="container" style="height:70vh;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12">

                <div class="card bg-secondary">
                    <div class="card-body">
                        <h1 class="pb-2">Quiz Results</h1>

                        <p class="mb-3 h5">
                            <strong>
                                <span v-if="result.correctAnswerCount > 0">Congratulations! </span>
                                <span v-else>Oops! </span>
                            </strong> You have answered correctly to <strong>{{ result.correctAnswerCount }} out of
                            {{ currentQuiz.questionCount }}</strong> questions! Check how you did below. When finished return to the start.</p>

                        <h4 class="mb-3">Your Performance ({{ getPerformancePercentage() }}% correct)</h4>

                        <div class="card mb-3" v-for="(answeredQuestion, key, index) in result.answeredQuestionList"
                             :class="getCorrectQuestionClass(answeredQuestion)" :key="key">
                            <div class="card-header bg-secondary">
                                {{index + 1 }}. {{ answeredQuestion.questionText }}
                                <span v-if="answeredQuestion.answeredCorrectly === 1" class="float-right text-success">Correct</span>
                                <span v-else class="float-right text-primary">Incorrect</span>
                            </div>
                        </div>

                        <button @click="endQuiz" class="btn btn-primary mt-1">Return to start</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            /**
             * @type {Quiz}
             */
            currentQuiz: {
                required: true,
            },

            /**
             * @type {Result}
             */
            result: {
                required: true,
            },
        },

        data() {
            return {
                questionCounter: 0,
            }
        },

        methods: {
            endQuiz() {
                this.$emit('quiz-finished');
            },

            getCorrectQuestionClass(question) {
                return {
                    'border-success': question.answeredCorrectly === 1,
                    'border-primary': question.answeredCorrectly === 0,
                }
            },

            getPerformancePercentage() {
                let correctAnswerCount = this.result.correctAnswerCount;
                let totalQuestionCount = this.currentQuiz.questionCount;

                return (((correctAnswerCount / totalQuestionCount) * 100)).toFixed();
            },
        },
    }
</script>