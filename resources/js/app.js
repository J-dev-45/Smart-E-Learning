import './bootstrap';

import { createApp, ref} from 'vue';

const app = createApp({
    setup() {
        const subjects = ref(window.initialSubjects || []);

        function handleSubjectAdded(newSubject) {
            if (!newSubject) return;

            const exists = subjects.value.some(
                subject => String(subject.id) === String(newSubject.id)
            );

            if (!exists) {
                subjects.value.push(newSubject);
            }
        }

        return {
            subjects,
            handleSubjectAdded
        };
    }
});

app.provide('appData', {
    name: 'smart-eLearning',
    logo: '/images/Components/Logo.png'
});

// ===================================================================================================|ADMIN
// ===================================================================================================|ADMIN
// ===================================================================================================|ADMIN

import Dashboard_Cards from './Vue/Admin/components/Dashboard_Cards.vue'
import Overview from './Vue/Admin/Pages/Overview.vue';
import Users from './Vue/Admin/Pages/Users.vue';
import Bottom_Navigation from './Vue/Admin/components/Bottom_Navigation.vue';
import Left_Navigation from './Vue/Admin/components/Left_Navigation.vue';
import Subjects_Navigation from './Vue/Admin/components/Subjects_Navigation.vue';
import Feedbacks from './Vue/Admin/Pages/Feedbacks.vue';
import Modules from './Vue/Admin/Pages/Modules.vue';
import Subjects_Cards_Admin from './Vue/Admin/Pages/Subjects_Cards_Admin.vue';
import Admin_Header from './Vue/Admin/components/Admin_Header.vue';
import Questions_Bank from './Vue/Admin/Pages/Questions_Bank.vue';
import Lesson_Management from './Vue/Admin/Pages/Lesson_Management.vue';

app.component('dashboard-cards', Dashboard_Cards);
app.component('overview', Overview);
app.component('users-page', Users);
app.component('bottom-navigation', Bottom_Navigation);
app.component('left-navigation', Left_Navigation);
app.component('subjects-navigation', Subjects_Navigation);
app.component('subjects-cards-admin', Subjects_Cards_Admin);
app.component('feedbacks-page', Feedbacks);
app.component('modules', Modules);
app.component('questions-bank', Questions_Bank);
app.component('lesson-management', Lesson_Management);
app.component('admin-header', Admin_Header);

// ===================================================================================================|CLIENT
// ===================================================================================================|CLIENT
// ===================================================================================================|CLIENT

import Subjects_Cards from './Vue/Client/Components/Subjects_Cards.vue';
import Assessment_Form from './Vue/Client/Pages/Assessment_Form.vue';
import Client_Navigation from './Vue/Client/Components/Client_Navigation.vue';
import Quiz_Modules from './Vue/Client/Pages/Quiz_Modules.vue';
import Choose_Module_Header from './Vue/Client/Components/Choose_Module_Header.vue';
import Taking_Assessment_Header from './Vue/Client/Components/Taking_Assessment_Header.vue';
import Assessment_Result from './Vue/Client/Pages/Assessment_Result.vue';
import User_Menu from './Vue/Client/Components/User_Menu.vue';
import CodePlayground from './Vue/Client/Pages/CodePlayground.vue';
import Learn_Header from './Vue/Client/Components/Learn_Header.vue';
import Leaderboard from './Vue/Client/Pages/Leaderboard.vue';
import Module_Activity from './Vue/Client/Pages/Module_Activity.vue';
import Module_Quiz_Buttons from './Vue/Client/Components/Module_Quiz_Buttons.vue';
import Feedback_Form from './Vue/Client/Modals/Feedback_Form.vue';
import Student_Profile from './Vue/Client/Components/Student_Profile.vue';
import Lesson_Content from './Vue/Client/Pages/Lesson_Content.vue';

app.component('subjects-card', Subjects_Cards);
app.component('assessment-form', Assessment_Form);
app.component('client-navigation', Client_Navigation);
app.component('quiz-modules', Quiz_Modules);
app.component('choose-module-header', Choose_Module_Header);
app.component('taking-assessment-header', Taking_Assessment_Header);
app.component('assessment-result', Assessment_Result);
app.component('user-menu', User_Menu);
app.component('code-playground', CodePlayground);
app.component('learn-header', Learn_Header)
app.component('leaderboard', Leaderboard);
app.component('module-activity', Module_Activity);
app.component('module-quiz-buttons', Module_Quiz_Buttons);
app.component('feedback-form', Feedback_Form);
app.component('student-profile', Student_Profile);
app.component('lesson-content', Lesson_Content);

// | AUTH |===================================================================================================
// | AUTH |===================================================================================================
// | AUTH |===================================================================================================

import Login from './Vue/Auth/Login.vue';
import Register from './Vue/Auth/Register.vue';
import Verify_Account from './Vue/Auth/Verify_Account.vue';
import Forgot_Password from './Vue/Auth/Forgot_Password.vue';



app.component('login', Login);
app.component('register', Register);
app.component('verify-account', Verify_Account);
app.component('forgot-password', Forgot_Password);


// ===================================================================================================|GLOBAL
// ===================================================================================================|GLOBAL
// ===================================================================================================|GLOBAL

import Loading_Screen from './Vue/Global/Loading_Screen.vue';
app.component('loading-screen', Loading_Screen);



app.mount('#app');