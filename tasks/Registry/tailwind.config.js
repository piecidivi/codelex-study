module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      backgroundImage: theme => ({
        'project-picture': "url('../images/shapelined-unsplash.jpg')"
      }),
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
