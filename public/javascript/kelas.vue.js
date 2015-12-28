$(document).ready(function () {
    var STORAGE_KEY = 'vue-kelas-app';

    var store = {
        fetch: function () {
            return JSON.parse(localStorage.getItem(STORAGE_KEY))
        },
        save: function (course) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(course));
            console.log(JSON.stringify(course))
        },
        destroy: function () {
            localStorage.removeItem(STORAGE_KEY);
        }
    }

    function ObjCourse() {
        this.name = '';
        this.description = '';
        this.chapters = [];
        this.exam = new ObjQuiz();
    }

    function ObjChapter() {
        this.name = '';
        this.content = '';
        this.order = 0;
        this.quiz = new ObjQuiz();
    }

    function ObjQuiz() {
        this.name = '';
        this.time = 0;
        this.questions = [];
    }

    function ObjQuestion() {
        this.question = '';
        this.option_a = '';
        this.option_b = '';
        this.option_c = '';
        this.option_d = '';
        this.correct = '';
    }

    new Vue({
        el: '#app-kelas-online',
        data: {
            course: new ObjCourse(),
            input: {}
        },
        watch: {
            course: {
                deep: true,
                handler: function (value) {
                    store.save(value);
                }
            }
        },
        methods: {            
            initData: function (storage) {
                if (!storage) {
                    storage = store.fetch();
                }

                $.extend(this.course, storage);
            },
            saveChapter: function () {
                console.log('kepanggil')
                var chapter = new ObjChapter();

                chapter.name = this.input.chapter.name;
                chapter.content = this.input.chapter.content;

                console.log(chapter)

                this.course.chapters.push(chapter);

                this.resetInput('chapter', new ObjChapter());
            },
            addChapterQuiz: function (chapterIndex) {
                this.input.chapterQuiz.chapterIndex = chapterIndex;
            },
            saveChapterQuiz: function () {
                var index = this.input.chapterQuiz.chapterIndex;
                var chapter = this.course.chapters[index];
                var quiz = chapter.quiz;
                var question = new ObjQuestion();

                question.question = this.input.chapterQuiz.question;
                question.option_a = this.input.chapterQuiz.option_a;
                question.option_b = this.input.chapterQuiz.option_b;
                question.option_c = this.input.chapterQuiz.option_c;
                question.option_d = this.input.chapterQuiz.option_d;
                question.correct = this.input.chapterQuiz.correct;

                quiz.questions.push(question);

                this.resetInput('chapterQuiz');
            },
            resetInput: function (name, data) {
                if (name) {
                    if (data)
                        this.input[name] = data;
                    else
                        this.input[name] = [];
                }
            },
            reset: function () {
                store.destroy();
                this.course = new ObjCourse();
            }
        },
        ready: function () {
            this.initData();
        }
    });
})