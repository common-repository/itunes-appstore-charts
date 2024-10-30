var store = {};
var store = {
	en:{
		audiobooks: 
		{
			title: 'Audiobooks', 
			childs: [
				{caption: 'Top Audiobooks', path: 'topaudiobooks'}
			],
			categories: [
				{genre: '50000041', caption: 'Arts &amp; Entertainment'},
				{genre: '50000070', caption: 'Audiobooks Latino'},
				{genre: '50000042', caption: 'Biography &amp; Memoir'},
				{genre: '50000043', caption: 'Business'},
				{genre: '50000045', caption: 'Classics'},
				{genre: '50000046', caption: 'Comedy'},
				{genre: '50000047', caption: 'Drama &amp; Poetry'},
				{genre: '50000040', caption: 'Fiction'},
				{genre: '50000049', caption: 'History'},
				{genre: '50000044', caption: 'Kids &amp; Young Adults'},
				{genre: '50000050', caption: 'Languages'},
				{genre: '50000051', caption: 'Mystery'},
				{genre: '74', caption: 'News'},
				{genre: '50000052', caption: 'Nonfiction'},
				{genre: '75', caption: 'Programs &amp; Performances'},
				{genre: '50000053', caption: 'Religion &amp; Spirituality'},
				{genre: '50000069', caption: 'Romance'},
				{genre: '50000055', caption: 'Sci-Fi &amp; Fantasy'},
				{genre: '50000054', caption: 'Science'},
				{genre: '50000056', caption: 'Self Development'},
				{genre: '50000048', caption: 'Speakers &amp; Storytellers'},
				{genre: '50000057', caption: 'Sports'},
				{genre: '50000058', caption: 'Technology'},
				{genre: '50000059', caption: 'Travel &amp; Adventure'}
			]
		},
		books: 
		{
			title: 'Books', 
			childs: [
				{caption: 'Top Paid Books', path: 'toppaidebooks'}, 
				{caption: 'Top Free Books', path: 'topfreebooks'}
			],
			categories: [
				{genre: '9007', caption: 'Arts &amp; Entertainment'},
				{genre: '9008', caption: 'Biographies &amp; Memoirs'},
				{genre: '9009', caption: 'Business &amp; Personal Finance'},
				{genre: '9010', caption: 'Children &amp; Teens'},
				{genre: '9026', caption: 'Comics &amp; Graphic Novels'},
				{genre: '9027', caption: 'Computers &amp; Internet'},
				{genre: '9028', caption: 'Cookbooks, Food &amp; Wine'},
				{genre: '9031', caption: 'Fiction &amp; Literature'},
				{genre: '9025', caption: 'Health, Mind &amp; Body'},
				{genre: '9015', caption: 'History'},
				{genre: '9012', caption: 'Humor'},
				{genre: '9024', caption: 'Lifestyle &amp; Home'},
				{genre: '9032', caption: 'Mysteries &amp; Thrillers'},
				{genre: '9002', caption: 'Nonfiction'},
				{genre: '9030', caption: 'Parenting'},
				{genre: '9034', caption: 'Politics &amp; Current Events'},
				{genre: '9029', caption: 'Professional &amp; Technical'},
				{genre: '9033', caption: 'Reference'},
				{genre: '9018', caption: 'Religion &amp; Spirituality'},
				{genre: '9003', caption: 'Romance'},
				{genre: '9020', caption: 'Sci-Fi &amp; Fantasy'},
				{genre: '9019', caption: 'Science &amp; Nature'},
				{genre: '9035', caption: 'Sports &amp; Outdoors'},
				{genre: '9004', caption: 'Travel &amp; Adventure'}             
			]
		},
		iosapps: 
		{
			title: 'iOS Apps', 
			childs: [
				{caption: 'Top Free Apps', path: 'topfreeapplications'},
				{caption: 'Top Paid Apps', path: 'toppaidapplications'},
				{caption: 'Top Grossing Apps', path: 'topgrossingapplications'},
				{caption: 'Top Free iPad Apps', path: 'topfreeipadapplications'},
				{caption: 'Top Paid iPad Apps', path: 'toppaidipadapplications'},
				{caption: 'Top Grossing iPad Apps', path: 'topgrossingipadapplications'},
				{caption: 'New Apps', path: 'newapplications'},
				{caption: 'New Free Apps', path: 'newfreeapplications'},
				{caption: 'New Paid Apps', path: 'newpaidapplications'}
			],
			categories: [
				{genre: '6018', caption: 'Books'},
				{genre: '6000', caption: 'Business'},
				{genre: '6017', caption: 'Education'},
				{genre: '6016', caption: 'Entertainment'},
				{genre: '6015', caption: 'Finance'},
				{genre: '6014', caption: 'Games'},
				{genre: '6013', caption: 'Health &amp; Fitness'},
				{genre: '6012', caption: 'Lifestyle'},
				{genre: '6020', caption: 'Medical'},
				{genre: '6011', caption: 'Music'},
				{genre: '6010', caption: 'Navigation'},
				{genre: '6009', caption: 'News'},
				{genre: '6008', caption: 'Photography'},
				{genre: '6007', caption: 'Productivity'},
				{genre: '6006', caption: 'Reference'},
				{genre: '6005', caption: 'Social Networking'},
				{genre: '6004', caption: 'Sports'},
				{genre: '6003', caption: 'Travel'},
				{genre: '6002', caption: 'Utilities'},
				{genre: '6001', caption: 'Weather'}
			]
		},
		macapps:
		{
			title: 'Mac Apps',
			childs: [
				{caption: 'Top Mac Apps', path: 'topmacapps'},
				{caption: 'Top Free Mac Apps', path: 'topfreemacapps'},
				{caption: 'Top Paid Mac Apps', path: 'toppaidmacapps'},
				{caption: 'Top Grossing Mac Apps', path: 'topgrossingmacapps'}
			],
			categories: [
				{genre: '12001', caption: 'Business'},
				{genre: '12002', caption: 'Developer Tools'},
				{genre: '12003', caption: 'Education'},
				{genre: '12004', caption: 'Entertainment'},
				{genre: '12005', caption: 'Finance'},
				{genre: '12006', caption: 'Games'},
				{genre: '12022', caption: 'Graphics &amp; Design'},
				{genre: '12007', caption: 'Health &amp; Fitness'},
				{genre: '12008', caption: 'Lifestyle'},
				{genre: '12010', caption: 'Medical'},
				{genre: '12011', caption: 'Music'},
				{genre: '12012', caption: 'News'},
				{genre: '12013', caption: 'Photography'},
				{genre: '12014', caption: 'Productivity'},
				{genre: '12015', caption: 'Reference'},
				{genre: '12016', caption: 'Social Networking'},
				{genre: '12017', caption: 'Sports'},
				{genre: '12018', caption: 'Travel'},
				{genre: '12019', caption: 'Utilities'},
				{genre: '12020', caption: 'Video'},
				{genre: '12021', caption: 'Weather'}
			]
		},
		movies:
		{
			title: 'Movies',
			childs: [
			      {caption: 'Top Movies', path: 'topmovies'},
			      {caption: 'Top Video Rentals', path: 'topvideorentals'}
			],
			categories: [
				{genre: '4401', caption: 'Action &amp; Adventure'},
				{genre: '4403', caption: 'Classics'},
				{genre: '4404', caption: 'Comedy'},
				{genre: '4405', caption: 'Documentary'},
				{genre: '4406', caption: 'Drama'},
				{genre: '4408', caption: 'Horror'},
				{genre: '4409', caption: 'Independent'},
				{genre: '4410', caption: 'Kids &amp; Family'},
				{genre: '4412', caption: 'Romance'},
				{genre: '4413', caption: 'Sci-Fi &amp; Fantasy'},
				{genre: '4414', caption: 'Short Films'},
				{genre: '4417', caption: 'Sports'},
				{genre: '4416', caption: 'Thriller'},
				{genre: '4418', caption: 'Western'}             
			]
		},
		music:
		{
			title: 'Music',
			childs: [
			    {caption: 'Top Albums', path: 'topalbums'},
			    {caption: 'Top iMixes', path: 'topimixes'},
			    {caption: 'Top Songs', path: 'topsongs'},
			    {caption: 'New Releases', path: 'newreleases'},
			    {caption: 'Just Added', path: 'justadded'},
			    {caption: 'Featured Albums &amp; Exclusives', path: 'featuredalbums'}
			],
			categories: [
				{genre: '20', caption: 'Alternative'},
				{genre: '2', caption: 'Blues'},
				{genre: '4', caption: 'Children\'s Music'},
				{genre: '22', caption: 'Christian &amp; Gospel'},
				{genre: '5', caption: 'Classical'},
				{genre: '3', caption: 'Comedy'},
				{genre: '6', caption: 'Country'},
				{genre: '17', caption: 'Dance'},
				{genre: '7', caption: 'Electronic'},
				{genre: '50', caption: 'Fitness &amp; Workout'},
				{genre: '18', caption: 'Hip Hop/Rap'},
				{genre: '8', caption: 'Holiday'},
				{genre: '11', caption: 'Jazz'},
				{genre: '12', caption: 'Latino'},
				{genre: '14', caption: 'Pop'},
				{genre: '15', caption: 'R&amp;B/Soul'},
				{genre: '24', caption: 'Reggae'},
				{genre: '21', caption: 'Rock'},
				{genre: '10', caption: 'Singer/Songwriter'},
				{genre: '16', caption: 'Soundtrack'},
				{genre: '50000061', caption: 'Spoken Word'},
				{genre: '19', caption: 'World'}
			]
		},
		musicvideo:
		{
			title: 'Music Video',
			childs: [
			    {caption: 'Top Misic Videos', path: 'topmusicvideos'}
			],
			categories: [
				{genre: '1620', caption: 'Alternative'},
				{genre: '1606', caption: 'Country'},
				{genre: '1607', caption: 'Electronic'},
				{genre: '1618', caption: 'Hip Hop/Rap'},
				{genre: '1612', caption: 'Latino'},
				{genre: '1614', caption: 'Pop'},
				{genre: '1615', caption: 'R&amp;B/Soul'},
				{genre: '1621', caption: 'Rock'}            
			]
		},
		podcasts:
		{
			title: 'Podcasts',
			childs: [
			    {caption: 'Top Podcasts', path: 'toppodcasts'}
			],
			categories: [
				{genre: '1301', caption: 'Arts'},
				{genre: '1321', caption: 'Business'},
				{genre: '1303', caption: 'Comedy'},
				{genre: '1304', caption: 'Education'},
				{genre: '1323', caption: 'Games &amp; Hobbies'},
				{genre: '1325', caption: 'Government &amp; Organizations'},
				{genre: '1307', caption: 'Health'},
				{genre: '1305', caption: 'Kids &amp; Family'},
				{genre: '1310', caption: 'Music'},
				{genre: '1311', caption: 'News &amp; Politics'},
				{genre: '1314', caption: 'Religion &amp; Spirituality'},
				{genre: '1315', caption: 'Science &amp; Medicine'},
				{genre: '1324', caption: 'Society &amp; Culture'},
				{genre: '1316', caption: 'Sports &amp; Recreation'},
				{genre: '1318', caption: 'Technology'},
				{genre: '1309', caption: 'TV &amp; Film'}
			]
		},
		tvshows:
		{
			title: 'TV Shows',
			childs: [
			    {caption: 'Top TV Episodes', path: 'toptvepisodes'},
			    {caption: 'Top TV Seasons', path: 'toptvseasons'},
			    {caption: 'Top TV Episode Rentals', path: 'toptvepisoderentals'}
			],
			categories: [
				{genre: '4002', caption: 'Animation'},
				{genre: '4004', caption: 'Classic'},
				{genre: '4000', caption: 'Comedy'},
				{genre: '4001', caption: 'Drama'},
				{genre: '4005', caption: 'Kids'},
				{genre: '4006', caption: 'Nonfiction'},
				{genre: '4007', caption: 'Reality TV'},
				{genre: '4008', caption: 'Sci-Fi &amp; Fantasy'},
				{genre: '4009', caption: 'Sports'},
				{genre: '4010', caption: 'Teens'}             
			]
		}
	}
};