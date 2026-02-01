
Morning all! 
I'll post this to the Teams chat as well.

# Today:
- Deployment Research
- API Development
	- Category & Joke should be completed
	- TODO: User 
	- TODO: Like/Dislike
	- TODO: Authentication
	- TODO: Testing for each
## Deployment Research & Testing

Finish off the research & testing on How to deploy a Laravel website to ScreenCraft.

The PDF from last week is on the Teams group chat.

If you have not got a group chat, then please make sure you create one and add Adrian to it

If you do not have a personal ScreenCraft subdomain, let Adrian know via a HelpDesk request.

## Jokes API Testing - Authentication

I have bookmarked on Diigo some useful web sites/pages to assist https://diigo.com/user/Ady_Gould/

Use search for terms like *authentication*, *sanctum*, *API*

I will be checking some YouTube videos as well - will post them to the teams chat as a reference

## Jokes API - Features (Recap)

- Category - BREAD

- User - Browse, Read
	- Staff/Admin/SuperAdmin - full BREAD

- Joke - BREAD
	- User/Staff/Admin/SuperAdmin - B, R any
	- User - A, E, D own
	- Staff/Admin/SuperAdmin - BREAD on all Jokes

- User - BREAD
	- This will only be for Staff/Admin/Super-Admin

- Authentication
	- Register for new users
	- Login for existing users
	- Logout for existing users

- User Profile - RED
	- This is because the only the USER & Staff/Admin/SuperAdmin has authority to Read, Edit and Delete the user

- Like/Dislike - May be tackled in a number of ways
	- Option 1 - Use Only POST to send value for like on a joke, code determines if C, E or D
	- Option 2 - Create full BREAD - and have each endpoint actioned as needed
	- Remember that user must be authenticated to like/dislike

## Questions?

Please ask in the Teams chat