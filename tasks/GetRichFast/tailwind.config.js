module.exports = {
  purge: [
      './public/**/*.css',
      './public/**/*.twig',
      './public/**/*.js',
      './app/Views/Templates/*.twig'
  ],
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
