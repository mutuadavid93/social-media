<template>
  <Head title="User" />

  <!-- 
    TIP: 

    max-w-[1100px]: Is the trick which makes sure that all our items are aligned left  
    and right side properly. It aligns major divs.


    min-h-[100vh] : The height should be 100% of the viewport height and increase 
    as the content requires it.
   -->

  <MainNavLayout>
    <div class="w-full min-h-[100vh] pb-20 bg-[#F1F2F5]">
      <div class="w-full bg-white">
        <div class="max-w-[1100px] pt-[56px] mx-auto pb-1">
          <img src="/labrador-chocolate.png" class="rounded-b-xl" />

          <div
            id="ProfileInfo"
            class="flex md:flex-row flex-col items-center justify-between px-4"
          >
            <div class="flex md:flex-row flex-col gap-4 md:-mt-6 -mt-16 items-center">
              <div class="relative">
                <img
                  :src="user.image"
                  class="rounded-full w-[165px] h-[165px] border-white border-4"
                />

                <!-- 
                  TIP:
                  Get currently logged in user's id, compare it to user's id from Database to 
                  confirm it's the actual user not a different user.

                  Otherwise hide ability to change profile picture.
                -->
                <button
                  v-if="$page.props.auth.user.id === user.id"
                  @click="isCropperModal = true"
                  class="absolute right-0 top-[100px] bg-gray-200 hover:bg-gray-300 p-1.5 rounded-full cursor-pointer"
                >
                  <Camera :size="25" />
                </button>
              </div>

              <div class="md:mt-4 text-center md:text-left -mt-3">
                <div class="text-[28px] font-extrabold pt-1">{{ user.name }}</div>
                <div
                  class="text-[17px] font-bold text-gray-600 mb-1.5 text-center md:text-left"
                >
                  246 friends
                </div>

                <!-- 
                  TIP: Trick to overlap images is;

                  - Have a white border
                  - First item should have a higher margin left or right
                  - The rest of the items can maintain a lower/negative margin
                  - Stack them by lowering z-index
                 -->
                <div class="flex md:justify-start justify-center md:-ml-1">
                  <img
                    src="https://picsum.photos/id/200/300/300"
                    class="rounded-full -ml-1 z-[10] w-[40px] h-[40px] border-white border-2"
                  />
                  <img
                    src="https://picsum.photos/id/203/300/300"
                    class="rounded-full -ml-3 z-[8] w-[40px] h-[40px] border-white border-2"
                  />
                  <img
                    src="https://picsum.photos/id/204/300/300"
                    class="rounded-full -ml-1 z-[7] w-[40px] h-[40px] border-white border-2"
                  />
                  <img
                    src="https://picsum.photos/id/255/300/300"
                    class="rounded-full -ml-3 z-[6] w-[40px] h-[40px] border-white border-2"
                  />
                  <img
                    src="https://picsum.photos/id/206/300/300"
                    class="rounded-full -ml-3 z-[5] w-[40px] h-[40px] border-white border-2"
                  />
                  <img
                    src="https://picsum.photos/id/230/300/300"
                    class="rounded-full -ml-1 z-[4] w-[40px] h-[40px] border-white border-2"
                  />
                  <img
                    src="https://picsum.photos/id/208/300/300"
                    class="rounded-full -ml-3 z-[3] w-[40px] h-[40px] border-white border-2"
                  />
                </div>
              </div>
            </div>

            <Link
              v-if="$page.props.auth.user.id === user.id"
              :href="route('profile.edit')"
              class="flex justify-center w-7/12 md:w-[160px] items-baseline md:my-0 my-4 bg-gray-200 hover:bg-gray-300 rounded-lg cursor-pointer"
            >
              <button class="flex items-center px-5 py-2 font-bold">
                <Pen :size="22" class="-ml-2 mr-1" /> Edit profile
              </button>
            </Link>
          </div>

          <div class="flex border-t h-[50px] py-[4px]">
            <!-- 
              NOTE: Navigation Bar
              We can have div elements inside buttons 
              -->
            <button class="w-[85px]">
              <!-- prettier-ignore -->
              <div
                class="flex items-center text-[15px] justify-center h-[45px] 
                text-blue-500 hover:bg-[#F2F2F2] w-full font-bold rounded-lg cursor-pointer"
              >
                Posts
              </div>
              <div class="border-b-4 border-b-blue-400 rounded-md"></div>
            </button>

            <button
              class="flex items-center text-[15px] justify-center h-[48px] p-1 hover:bg-[#F2F2F2] w-[85px] font-bold rounded-lg mx-1 cursor-pointer"
            >
              About
            </button>
            <button
              class="flex items-center text-[15px] justify-center h-[48px] p-1 hover:bg-[#F2F2F2] w-[85px] font-bold rounded-lg mx-1 cursor-pointer"
            >
              Friends
            </button>
            <button
              class="flex items-center text-[15px] justify-center h-[48px] p-1 hover:bg-[#F2F2F2] w-[85px] font-bold rounded-lg mx-1 cursor-pointer"
            >
              Videos
            </button>
            <button
              class="flex items-center text-[15px] justify-center h-[48px] p-1 hover:bg-[#F2F2F2] w-[85px] font-bold rounded-lg mx-1 cursor-pointer"
            >
              Photos
            </button>
            <button
              class="flex items-center text-[15px] justify-center h-[48px] p-1 hover:bg-[#F2F2F2] w-[85px] font-bold rounded-lg mx-1 cursor-pointer"
            >
              Check-ins
            </button>
          </div>
        </div>
      </div>

      <!-- MAIN CONTENT SECTION -->
      <div
        class="flex-cols md:flex w-full max-w-[1100px] justify-between h-[calc(100%-56px)] md:px-0 px-2 mx-auto"
      >
        <div id="LeftSection" class="w-full md:w-5/12 mt-4 mr-4">
          <div class="bg-white p-3 rounded-lg shadow-lg">
            <div class="font-extrabold pb-2 text-xl">Intro</div>
            <div class="pb-5">
              <button
                class="w-full bg-gray-200 hover:bg-gray-300 rounded-lg p-2 font-bold"
              >
                Add bio
              </button>
            </div>
            <div class="pb-5">
              <button
                class="w-full bg-gray-200 hover:bg-gray-300 rounded-lg p-2 font-bold"
              >
                Edit details
              </button>
            </div>
            <div class="pb-5">
              <button
                class="w-full bg-gray-200 hover:bg-gray-300 rounded-lg p-2 font-bold"
              >
                Add hobbies
              </button>
            </div>
            <div class="pb-5">
              <button
                class="w-full bg-gray-200 hover:bg-gray-300 rounded-lg p-2 font-bold"
              >
                Add feature
              </button>
            </div>
          </div>

          <div class="bg-white p-3 mt-4 rounded-lg shadow-lg">
            <div class="font-extrabold pb-2 text-xl">Photos</div>
            <!-- NOTE: flex-wrap: items will stay in a single line and won't wrap -->
            <div class="flex flex-wrap items-center justify-start w-full">
              <!-- w-1/3: 33% -->
              <span
                v-for="photo in posts.data"
                v-show="photo.image !== null"
                :key="photo"
                class="w-1/3"
              >
                <img
                  @click="isImageDisplay = photo.image"
                  :src="photo.image"
                  class="aspect-square object-cover p-1 rounded-lg cursor-pointer"
                />
              </span>
            </div>
          </div>
        </div>

        <div id="PostSection" class="w-full md:w-7/12 overflow-auto">
          <!-- TIP: allow the correct user to create a post or see `what's on your mind status section` -->
          <CreatePostBox
            v-if="$page.props.auth.user.id === user.id"
            :image="user.image"
            :placeholder="`What's on your mind ${user.name}`"
          />

          <div v-for="post in posts.data" :key="post">
            <Post :user="post.user" :post="post" :comments="post.comments" />
          </div>
        </div>
      </div>
    </div>
  </MainNavLayout>
</template>

<script setup>
import { computed } from "vue";
import { Link, Head } from "@inertiajs/vue3";
import MainNavLayout from "@/Layouts/MainNavLayout.vue";
import CreatePostBox from "@/Components/CreatePostBox.vue";
import Post from "@/Components/Post.vue";

import Camera from "vue-material-design-icons/Camera.vue";
import Pen from "vue-material-design-icons/Pen.vue";

import { useGeneralStore } from "@/stores/general";
import { storeToRefs } from "pinia";
const useGeneral = useGeneralStore();
const { isCropperModal, isImageDisplay } = storeToRefs(useGeneral);

// NOTE: This comes from UserController as props
const { posts, user } = defineProps({ posts: Object, user: Object });
</script>
