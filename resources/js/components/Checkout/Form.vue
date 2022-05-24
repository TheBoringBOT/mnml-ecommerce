<template>
    <form
            @submit.prevent="processPayment"
            :validation-schema="validationSchema"
    >
        <div class="w-full mx-auto">
            <div class="flex flex-wrap -mx-2">
                <!-- first name -->
                <div class="p-2 w-full pt-0">
                    <div class="relative">
                        <label
                                for="first_name"
                                class="leading-7 text-sm text-gray-600"
                        >First Name</label
                        >
                        <Field
                                type="text"
                                id="first_name"
                                name="first_name"
                                required
                                class="w-full bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="customer.first_name"
                                :disabled="paymentProcessing"
                        />
                        <ErrorMessage name="first_name"/>
                    </div>
                </div>
                <!-- last name -->
                <div class="p-2 w-full">
                    <div class="relative">
                        <label
                                for="last_name"
                                class="leading-7 text-sm text-gray-600"
                        >Last Name</label
                        >
                        <Field
                                required
                                type="text"
                                id="last_name"
                                name="last_name"
                                class="w-full bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="customer.last_name"
                                :disabled="paymentProcessing"
                        />
                        <ErrorMessage name="last_name"/>
                    </div>
                </div>
                <!-- email -->
                <div class="p-2 w-full">
                    <div class="relative">
                        <label
                                for="email"
                                class="leading-7 text-sm text-gray-600"
                        >Email Address</label
                        >
                        <Field
                                required
                                type="email"
                                id="email"
                                name="email"
                                class="w-full bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="customer.email"
                                :disabled="paymentProcessing"
                        />
                        <ErrorMessage name="email"/>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-2">
                <!-- address -->
                <div class="p-2 w-full">
                    <div class="relative">
                        <label
                                for="address"
                                class="leading-7 text-sm text-gray-600"
                        >Street Address</label
                        >
                        <Field
                                required
                                type="text"
                                id="address"
                                name="address"
                                class="w-full bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="customer.address"
                                :disabled="paymentProcessing"
                        />
                        <ErrorMessage name="address"/>
                    </div>
                </div>
                <!-- city -->
                <div class="p-2 w-full">
                    <div class="relative">
                        <label
                                for="city"
                                class="leading-7 text-sm text-gray-600"
                        >City</label
                        >
                        <Field
                                required
                                type="text"
                                id="city"
                                name="city"
                                class="w-full bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="customer.city"
                                :disabled="paymentProcessing"
                        />
                        <ErrorMessage name="city"/>
                    </div>
                </div>
                <!-- state -->
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label
                                for="state"
                                class="leading-7 text-sm text-gray-600"
                        >State</label
                        >
                        <Field
                                required
                                type="text"
                                id="state"
                                name="state"
                                class="w-full bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="customer.state"
                                :disabled="paymentProcessing"
                        />
                        <ErrorMessage name="state"/>
                    </div>
                </div>
                <!-- zip code -->
                <div class="p-2 w-1/2">
                    <div class="relative">
                        <label
                                for="zip_code"
                                class="leading-7 text-sm text-gray-600"
                        >Zip Code</label
                        >
                        <Field
                                required
                                type="text"
                                id="zip_code"
                                name="zip_code"
                                class="w-full bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="customer.zip_code"
                                :disabled="paymentProcessing"
                        />
                        <ErrorMessage name="zip_code"/>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-2">
                <div class="p-2 w-full">
                    <div class="relative">
                        <label
                                for="card-element"
                                class="leading-7 text-sm text-gray-600"
                        >Credit Card Info</label
                        >
                        <div id="card-element"></div>
                    </div>
                </div>
            </div>
            <div class="py-2 w-full mt-4">
                <button
                        class="block text-center items-center justify-center w-full flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg font-semibold tracking-wide"
                        type="submit"
                        v-text="
                        paymentProcessing ? 'Processing...' : `Pay ${cartTotal}`
                    "
                ></button>
            </div>
        </div>
    </form>
</template>

<script>
import {Field, Form, ErrorMessage} from "vee-validate";
import * as yup from "yup";

export default {
    components: {
        yup,
        Field,
        Form,
        ErrorMessage,
    },
    data() {
        //form validation using yup
        const validationSchema = yup.object({
            email: yup.string().required().email(),
            first_name: yup.string().required(),
            last_name: yup.string().required(),
            address: yup.string().required(),
            city: yup.string().required(),
            state: yup.string().required(),
            zip_code: yup.string().required(),
        });
        return {
            validationSchema,
            errors: [],
        };
    },
    props: ["customer", "paymentProcessing", "cartTotal"],
};
</script>
