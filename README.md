# laravel-graphql

# Mutations 
- Auth/LoginMutation - mutation for login. It returns <strong>token</strong>
- Post/CreatePostMutation - it allows creating post. Required authentication and editor role
- User/CreateUserMutation - it allows creating user. It requireds only authentication

# Queries
- Post/PostsPaginateQuery - it returns paginated posts
- Post/PostsQuery - it returns all posts from db
- User/UsersQuery - it returns all users and allows getting user by specific id 
