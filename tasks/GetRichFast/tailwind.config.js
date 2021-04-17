module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      backgroundImage: theme => ({
        'project-picture': "url('../images/joyce-mccown-unsplash.jpg')"
      }),
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
