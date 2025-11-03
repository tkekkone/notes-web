# Release notes with git log

Generate nice markdown release notes, starting from a commit(here 7602..):

```
git --no-pager log 7602f9b.. --simplify-by-decoration --grep="Merged PR" --pretty=tformat:"## %(describe)%n%n### %ad %n%n%b" > /mnt/c/temp/release.md
```
