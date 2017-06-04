module.exports = {
	entry:{
		index:__dirname + "/js/index.js"
	},
	output:{
		path:__dirname + "/",
		filename:"index.js"
	},
	watch: true,
	module: {
		loaders:[
		    {
		        test: /\.js$/,
		        exclude: /node_modules/,
		        loader: 'babel-loader',//在webpack的module部分的loaders里进行配置即可
		        query: {
		           presets: ['es2015','react']
        		}
      		},
      		{
      			test: /\.vue$/,
      			loader:"vue-loader"
      		},
      		{
				test:/\.(gif|jpg|png)\??.*$/,
				loader:'url-loader?name=[path][name].[ext]'
			},
			{   
				test: /\.css$/, 
				loader: 'style-loader!css-loader' 
			},
			{
          		test: /\.(woff|woff2|svg|eot|ttf)\??.*$/,
         		loader: 'file-loader?name=/css/fonts/[name].[ext]'
        	}
		],
	}


}