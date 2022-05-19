<template>
    <BreezeAuthenticatedLayout>
        <div class="text-white bg-primary-bg font-semibold">
            <div class="md:grid md:grid-cols-6 md:gap-6">
                <div class="mt-5 md:mt-0 md:col-span-6 text-gray-700">
                    <form
                        @submit.prevent="submit"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        <div
                            class="bg-white p-5 p-10 sm:rounded-md sm:overflow-hidden"
                        >
                            <div class="space-y-6">
                                <div
                                    class="flex flex-col md:flex-row items-center space-y-5 md:space-y-0 md:space-x-5"
                                >
                                    <!--Name -->

                                    <div class="w-full md:w-1/2">
                                        <label
                                            for="name"
                                            class="block text-gray-500"
                                        >
                                            Name
                                        </label>
                                        <div
                                            class="mt-1 flex flex-col rounded-md shadow-sm"
                                        >
                                            <input
                                                v-model="form.name"
                                                type="text"
                                                id="name"
                                                name="name"
                                                autocomplete="off"
                                                class="rounded font-semibold flex-1 block w-full border-gray-300"
                                            />
                                            <div
                                                class="py-5 text-red-500"
                                                v-if="errors.name"
                                            >
                                                {{ errors.name }}
                                            </div>
                                        </div>
                                    </div>
                                    <!--Price -->

                                    <div class="w-full md:w-1/2">
                                        <label
                                            for="price"
                                            class="block text-gray-500"
                                        >
                                            Price
                                        </label>
                                        <div
                                            class="mt-1 flex flex-col rounded-md shadow-sm"
                                        >
                                            <input
                                                v-model="form.price"
                                                type="text"
                                                id="price"
                                                name="price"
                                                autocomplete="off"
                                                class="rounded font-semibold focus:border-black flex-1 block w-full border-gray-300"
                                            />
                                            <div
                                                class="py-5 text-red-500"
                                                v-if="errors.price"
                                            >
                                                {{ errors.price }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div
                                        class="flex flex-col md:flex-row items-center space-y-5 md:space-y-0 md:space-x-5"
                                    >
                                        <!-- available -->
                                        <div class="w-full md:w-1/3">
                                            <label
                                                for="available"
                                                class="block text-gray-500"
                                            >
                                                Available
                                            </label>
                                            <div
                                                class="mt-1 flex flex-col rounded-md shadow-sm"
                                            >
                                                <input
                                                    v-model="form.available"
                                                    type="number"
                                                    id="available"
                                                    name="available"
                                                    autocomplete="off"
                                                    class="rounded font-semibold focus:border-black flex-1 block w-full border-gray-300"
                                                />
                                                <div
                                                    class="py-5 text-red-500"
                                                    v-if="errors.available"
                                                >
                                                    {{ errors.available }}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- care -->

                                        <div class="w-full md:w-1/3">
                                            <label
                                                for="care"
                                                class="block text-gray-500"
                                            >
                                                Care Instructions
                                            </label>
                                            <div
                                                class="mt-1 flex flex-col rounded-md shadow-sm"
                                            >
                                                <input
                                                    v-model="form.care"
                                                    type="text"
                                                    id="care"
                                                    name="care"
                                                    autocomplete="off"
                                                    class="rounded font-semibold focus:border-black flex-1 block w-full border-gray-300"
                                                />
                                                <div
                                                    class="py-5 text-red-500"
                                                    v-if="errors.care"
                                                >
                                                    {{ errors.care }}
                                                </div>
                                            </div>
                                        </div>

                                        <!--materials -->

                                        <div class="w-full md:w-1/3">
                                            <label
                                                for="materials"
                                                class="block text-gray-500"
                                            >
                                                Materials
                                            </label>
                                            <div
                                                class="mt-1 flex flex-col rounded-md shadow-sm"
                                            >
                                                <input
                                                    v-model="form.materials"
                                                    type="text"
                                                    id="materials"
                                                    name="materials"
                                                    autocomplete="off"
                                                    class="rounded font-semibold focus:border-black flex-1 block w-full border-gray-300"
                                                />
                                                <div
                                                    class="py-5 text-red-500"
                                                    v-if="errors.materials"
                                                >
                                                    {{ errors.materials }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- categories -->

                                    <div>
                                        <label
                                            for="multiselect"
                                            class="mb-1 block text-gray-500"
                                        >
                                            Categories
                                        </label>
                                        <!--v-model="tagsSelector.value"-->
                                        <Multiselect
                                            id="multiselect"
                                            class="multiselect-style"
                                            placeholder="Choose product category"
                                            v-model="form.categories"
                                            v-bind="categoriesSelector"
                                        ></Multiselect>
                                    </div>

                                    <!-- description -->
                                    <div>
                                        <div>
                                            <label
                                                for="description"
                                                class="block text-gray-500"
                                            >
                                                Description
                                            </label>
                                            <div
                                                class="mt-1 flex flex-col rounded-md shadow-sm"
                                            >
                                                <textarea
                                                    id="description"
                                                    v-model="form.description"
                                                    name="description"
                                                    rows="4"
                                                    maxlength="200"
                                                    class="resize-none shadow-sm focus:border-black text-xl mt-1 block w-full border border-gray-300 rounded-md border-gray-300"
                                                />

                                                <div
                                                    class="py-5 text-red-500"
                                                    v-if="errors.description"
                                                >
                                                    {{ errors.description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- story -->
                                    <div>
                                        <div>
                                            <label
                                                for="description"
                                                class="block text-gray-500"
                                            >
                                                Product Story
                                            </label>
                                            <div
                                                class="mt-1 flex flex-col rounded-md shadow-sm"
                                            >
                                                <textarea
                                                    id="story"
                                                    v-model="form.story"
                                                    name="story"
                                                    rows="4"
                                                    maxlength="200"
                                                    class="resize-none shadow-sm focus:border-black text-xl mt-1 block w-full border border-gray-300 rounded-md border-gray-300"
                                                />

                                                <div
                                                    class="py-5 text-red-500"
                                                    v-if="errors.story"
                                                >
                                                    {{ errors.story }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-lg text-gray-500"
                                        >
                                            Add product images
                                        </label>
                                        <div
                                            class="mt-1 flex justify-start py-6 rounded-md"
                                        >
                                            <div class="space-y-1 text-center">
                                                <div
                                                    class="flex flex-col text-sm"
                                                >
                                                    <label
                                                        for="file-upload"
                                                        class="text-2xl relative cursor-pointer font-semibold hover: text-gray-500 justify-start text-left"
                                                    >
                                                        <span
                                                            v-if="form.images"
                                                            >{{
                                                                form.images.name
                                                            }}</span
                                                        >
                                                        <input
                                                            @input="
                                                                form.images =
                                                                    $event.target.files
                                                            "
                                                            id="file-upload"
                                                            name="file-upload"
                                                            type="file"
                                                            multiple
                                                        />
                                                    </label>
                                                    <div
                                                        class="py-5 text-red-500"
                                                        v-if="errors.image_file"
                                                    >
                                                        {{ errors.image_file }}
                                                    </div>

                                                    <p class="pl-1"></p>
                                                </div>
                                                <p
                                                    class="text-xs italic text-gray-400 text-left"
                                                >
                                                    (PNG & JPG accepted)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-3 text-right">
                                    <button
                                        type="submit"
                                        class="inline-flex w-full justify-center py-5 px-4 border border-transparent shadow-sm text-xl font-bold rounded-md text-white bg-black hover:bg-black-hover focus:outline-none focus:ring-2 focus:ring-offset-2"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { useForm, Head } from "@inertiajs/inertia-vue3";
import Multiselect from "@vueform/multiselect";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { useToast } from "vue-toastification";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Multiselect,
    },
    props: ["errors", "product", "categories"],

    data(props) {
        return {
            categoriesSelector: {
                mode: "tags",
                value: [""],
                closeOnSelect: false,
                options: props.categories ? props.categories : null,
                searchable: true,
                createOption: true,
            },
        };
    },
    methods: {
        formatCurrency(amount) {
            amount = amount / 100;
            return amount.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },
    },

    setup(props) {
        // create toast notifications function
        const toast = useToast();

        const form = useForm({
            name: props.product.name,
            price: props.product.price,
            materials: props.product.materials,
            care: props.product.care,
            categories: props.product.categories,
            description: props.product.description,
            story: props.product.story,
            available: props.product.available,
            image_file: props.product.image_file && null,
        });

        function submit() {
            console.table(form);

            form.put(`/dashboard/product/edit/${props.product.id}`, {
                preserveScroll: true,
                onSuccess: () => (
                    form.reset(), this.toast.info("Upload was successful")
                ),
            });
        }

        return { form, submit, toast };
    },
};
</script>

<!--Styles for multiselect -->

<style src="@vueform/multiselect/themes/default.css"></style>

<!-- Using the `scoped` attribute -->
