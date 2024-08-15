# Creating Good Commit Messages

Commit messages **must** use the conventional commit style. This is outlined below:

| Type of commit          | Prefix    | Example                                 | Notes         |
| ----------------------- | --------- | --------------------------------------- | ------------- |
| Start of project        | init      | init: Start of Project                  |               |
| Feature work            | feat      | feat: Add User create method            |               |
| Feature with identifier | feat(...) | feat(user): Add create method           | **preferred** |
| Bug fix                 | fix(...)  | fix(user): Fix issue #1234              |               |
| Documentation           | docs(...) | docs(user): Update Scribe documentation | **preferred** |
|                         |           |                                         |               |
|                         |           |                                         |               |

Other conventional commit message types are available, and you are directed to [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) for more guidance and examples.

Note that conventional commits allow for multiple line comments. 

For example:

```text
feat(user): Update browse API

- Add pagination to user API
- Add example use to API docs

close #1234
```

You may also link commits to your issues, and automatically close them by using the following keywords and syntax:

- `fix #xxx`
- `close #xxx`
- `resolve #xxx`

We suggest using `close` when completing a new (sub-)feature and `resolve` when completing a bug-fix.

Further useful details see the [S04-GitHub-Project-Management](S04-GitHub-Project-Management.md) notes.
