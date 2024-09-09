<template>
  <v-container fluid class="pa-0">
    <v-carousel
      hide-delimiters
      show-arrows-on-hover
      cycle
      class="carousel"
      height="400px"
    >
      <v-carousel-item
        v-for="(item, index) in carouselItems"
        :key="index"
       class="carousel-item"
      >
      <v-row class="fill-height no-gutters">
        <!-- Image Section -->
       
        <v-col cols="6" class="card-col d-flex align-center">
          <v-card class="advertisement-card" color="transparent" flat>
            <v-card-text class="text-center white--text">
              <h2>{{ item.text }}</h2>
              <v-btn class="mt-4" color="primary"   to="/products" large >Shop Now</v-btn>
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="6" class="image-col">
          <v-img
            :src="item.image"
            class="image"
            contain
          ></v-img>
        </v-col>
      </v-row>
    </v-carousel-item>
    
    </v-carousel>
    <v-row class="mt-10">
      <v-col cols="12" md="4">
        <v-card class="hoverable">
          <v-img
            src="/public/images/red rose 4 - Copy.jpg"
            alt="Flower Bouquet"
            height="500px"
          ></v-img>
          <v-card-title>Elegant Bouquets</v-card-title>
          <v-card-text>
            Explore our wide selection of flower bouquets, perfect for any
            occasion.
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" block to="/products">Browse Bouquets</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col cols="12" md="4">
        <v-card class="hoverable">
          <v-img
            src="/public/images/wine.jpg"
            alt="Wine"
            height="500px"
          ></v-img>
          <v-card-title>Premium Wines</v-card-title>
          <v-card-text>
            Complement your bouquet with a bottle of our finest wine.
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" block to="/accompaniments"
              >Browse Wines</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col cols="12" md="4">
        <v-card class="hoverable">
          <v-img
            src="/public/images/teddy.jpg"
            alt="Teddy Bear"
            height="500px"
          ></v-img>
          <v-card-title>Adorable Teddy Bears</v-card-title>
          <v-card-text>
            Add a cute teddy bear to make your gift even more special.
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" block to="/accompaniments"
              >Browse Teddy Bears</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-row class="mt-10">
      <v-col cols="12">
        <v-card class="hoverable">
          <v-card-title>Quick Delivery</v-card-title>
          <v-card-text>
            We ensure fast and reliable delivery to make sure your gifts arrive
            on time.
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" block>Learn More</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <!-- footer -->
    <v-footer padless class="footer">
      <v-row class="fill-height" align="center" justify="center">
        <v-col cols="12" md="4" class="d-flex flex-column align-center">
          <v-img
            src="/public/images/Neutral Beige Simple Aesthetic Flower Boutique Logo.png"
            alt="Company Logo"
            max-width="150"
            class="mb-3"
          ></v-img>
          <div class="text-center">
            <p class="mb-2">© 2024 BloomBox. All rights reserved.</p>
            <p class="mb-2">123 Flower Street, Bloom City, BC 12345</p>
            <p class="mb-2">Email: contact@bloombox.com</p>
            <p class="mb-2">Phone: (123) 456-7890</p>
          </div>
        </v-col>
        <v-col cols="12" md="4" class="d-flex flex-column align-center">
          <v-list>
            <v-list-item
              class="footer-item"
              v-for="(item, index) in footerLinks"
              :key="index"
            >
              <router-link :to="item.route" class="footer-link">
                {{ item.title }}
              </router-link>
            </v-list-item>
          </v-list>
        </v-col>

        <v-col cols="12" md="4" class="d-flex flex-column align-center">
          <v-list class="social-media">
            <v-list-item class="social-icon">
              <a
                href="https://facebook.com"
                target="_blank"
                rel="noopener noreferrer"
              >
                <v-icon>mdi-facebook</v-icon>
              </a>
            </v-list-item>
            <v-list-item class="social-icon">
              <a
                href="https://twitter.com"
                target="_blank"
                rel="noopener noreferrer"
              >
                <v-icon>mdi-twitter</v-icon>
              </a>
            </v-list-item>
            <v-list-item class="social-icon">
              <a
                href="https://instagram.com"
                target="_blank"
                rel="noopener noreferrer"
              >
                <v-icon>mdi-instagram</v-icon>
              </a>
            </v-list-item>
            <v-list-item class="social-icon">
              <a
                href="https://linkedin.com"
                target="_blank"
                rel="noopener noreferrer"
              >
                <v-icon>mdi-linkedin</v-icon>
              </a>
            </v-list-item>
          </v-list>
        </v-col>
      </v-row>
    </v-footer>
  </v-container>
</template>
<script>
import "/public/flower.mp4";
// export default {
//   name: "VideoCard",
//   name: "FullScreenVideo",
// };
export default {
  data() {
    return {
      carouselItems: [
        { image: '/public/images/social 1.jpg', text: 'Get special offers for your delivery!' },
        { image: '/public/images/social 2.jpg', text: "Crafting Beautiful Moments – Perfect Flowers, Thoughtful Accompaniments, and Unforgettable Memories!" },
        { image: '/public/images/social 4.jpg', text: 'Quick and reliable flower delivery!' },
        // Add more items as needed
      ],
    };
  }
}
</script>

<style scoped>
.carousel {
  position: relative;
}
.v-carousel-item {
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50% 50%;


}
.image-col {
  padding: 0;
}
.image {
  width: 100%;
  height: 100%;
  object-fit: cover;

}
.card-col {
  display: flex;
  align-items: center;
  justify-content: center;
}
.advertisement-card {
  padding: 2rem;
  border-radius: 12px;
  max-width: 400px;
}

.v-carousel-item {
  display: flex;
  align-items: center;
  justify-content: center;
}
.footer {
  background-color: #4a148c;
  color: #ffffff;
  padding: 2rem;
}
.overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}
.overlay-button {
  background-color: rgba(255, 255, 255, 0.8);
  color: #4a148c;
  font-weight: bold;
  width: 10rem;
  height: 100px;
  transition: background-color 0.3s ease;
}
.overlay-button:hover {
  background-color: #4a148c;
}

.hoverable {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hoverable:hover {
  transform: translateY(-8px);
  box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.1);
}
.footer-link {
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
}
.footer-link:hover {
  text-decoration: underline;
}
.social-media {
  display: flex;
  justify-content: center;
}
.social-icon {
  margin: 0 10px;
}
.social-icon a {
  font-size: 1.5rem;
}
</style>
