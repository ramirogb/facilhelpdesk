USE [helpdesk]
GO
/****** Object:  Table [dbo].[users_staff]    Script Date: 04/29/2010 13:35:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users_staff](
	[userx] [int] NULL,
	[departament] [smallint] NULL,
	[departament_visible] [smallint] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[users](
	[id] [bigint] IDENTITY(4,1) NOT NULL,
	[name] [varchar](50) NOT NULL,
	[username] [varchar](16) NOT NULL,
	[password] [varchar](16) NOT NULL,
	[email] [varchar](100) NOT NULL,
	[lastlogin] [bigint] NULL,
	[newlogin] [bigint] NULL,
	[admin] [varchar](5) NOT NULL,
	[status] [tinyint] NOT NULL,
	[added] [bigint] NULL,
	[comments] [varchar](max) NULL,
	[company] [varchar](50) NULL,
	[website] [varchar](70) NULL,
 CONSTRAINT [PK_users_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY],
 CONSTRAINT [users$username] UNIQUE NONCLUSTERED 
(
	[username] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE NONCLUSTERED INDEX [tickets_users_admin] ON [dbo].[users] 
(
	[admin] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [tickets_users_status] ON [dbo].[users] 
(
	[status] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [tickets_users_username] ON [dbo].[users] 
(
	[username] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tracking]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tracking](
	[id] [bigint] IDENTITY(494,1) NOT NULL,
	[ticket_id] [bigint] NULL,
	[staff] [varchar](16) NULL,
	[action] [varchar](40) NULL,
	[tdate] [bigint] NULL,
 CONSTRAINT [tracking$id] UNIQUE CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tickets_tickets]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tickets_tickets](
	[tickets_id] [bigint] IDENTITY(136,1) NOT NULL,
	[tickets_username] [varchar](16) NOT NULL,
	[tickets_subject] [varchar](50) NOT NULL,
	[tickets_timestamp] [bigint] NOT NULL,
	[tickets_name] [varchar](50) NOT NULL,
	[tickets_email] [varchar](50) NOT NULL,
	[tickets_urgency] [tinyint] NOT NULL,
	[tickets_category] [tinyint] NOT NULL,
	[tickets_admin] [varchar](20) NOT NULL,
	[tickets_child] [bigint] NOT NULL,
	[tickets_question] [varchar](max) NOT NULL,
	[unread_admin] [smallint] NULL,
	[unread_user] [smallint] NULL,
	[previous] [bigint] NULL,
	[eta] [bigint] NULL,
	[reserved] [varchar](1) NOT NULL,
 CONSTRAINT [PK_tickets_tickets_tickets_id] PRIMARY KEY CLUSTERED 
(
	[tickets_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE NONCLUSTERED INDEX [tickets_category] ON [dbo].[tickets_tickets] 
(
	[tickets_category] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [tickets_child] ON [dbo].[tickets_tickets] 
(
	[tickets_child] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [tickets_urgency] ON [dbo].[tickets_tickets] 
(
	[tickets_urgency] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [tickets_username] ON [dbo].[tickets_tickets] 
(
	[tickets_username] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tickets_state]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tickets_state](
	[id] [int] NULL,
	[closed_by] [varchar](16) NULL,
	[opened_by] [varchar](16) NULL,
	[hold_by] [varchar](16) NULL,
	[tickets_status] [char](1) NULL,
	[assigned] [varchar](1) NULL,
	[assigned_to] [varchar](20) NULL,
	[keyview] [varchar](6) NULL,
 CONSTRAINT [tickets_state$id] UNIQUE NONCLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tickets_poll]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tickets_poll](
	[id] [int] NULL,
	[a] [char](1) NULL,
	[b] [char](1) NULL,
	[c] [char](1) NULL,
	[d] [char](1) NULL,
	[e] [char](1) NULL,
	[timestamp] [bigint] NULL,
	[comment] [varchar](255) NULL,
	[staff] [int] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tickets_levels]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tickets_levels](
	[id] [tinyint] IDENTITY(5,1) NOT NULL,
	[name] [varchar](20) NOT NULL,
	[orderx] [tinyint] NOT NULL,
	[color] [varchar](6) NOT NULL,
 CONSTRAINT [PK_tickets_levels_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE NONCLUSTERED INDEX [tickets_status_name] ON [dbo].[tickets_levels] 
(
	[name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [tickets_status_order] ON [dbo].[tickets_levels] 
(
	[orderx] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tickets_categories]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tickets_categories](
	[tickets_categories_id] [int] IDENTITY(3,1) NOT NULL,
	[tickets_categories_name] [varchar](20) NOT NULL,
	[tickets_categories_order] [tinyint] NOT NULL,
	[email] [varchar](100) NULL,
	[password] [varchar](30) NULL,
	[epiping] [varchar](1) NULL,
	[emailpiping] [varchar](100) NULL,
	[maxfile] [int] NULL,
	[sms] [varchar](15) NULL,
	[supervisor] [varchar](100) NOT NULL,
 CONSTRAINT [PK_tickets_categories_tickets_categories_id] PRIMARY KEY CLUSTERED 
(
	[tickets_categories_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY],
 CONSTRAINT [tickets_categories$tickets_categories_name] UNIQUE NONCLUSTERED 
(
	[tickets_categories_name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE NONCLUSTERED INDEX [tickets_categories_order] ON [dbo].[tickets_categories] 
(
	[tickets_categories_order] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tickets_atach]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tickets_atach](
	[tickets_id] [bigint] NOT NULL,
	[atachmen] [varchar](100) NULL,
	[atachmen_new] [varchar](100) NULL,
	[archi] [varbinary](max) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[spam]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[spam](
	[id] [bigint] NOT NULL,
	[spa] [varchar](max) NULL,
	[filter] [varchar](1) NULL,
	[deletespam] [varchar](1) NULL,
 CONSTRAINT [PK_spam_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY],
 CONSTRAINT [spam$id] UNIQUE NONCLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[error_log]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[error_log](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[action] [varchar](100) NULL,
	[timestamp] [bigint] NULL,
	[delay] [varchar](16) NULL,
 CONSTRAINT [error_log$id] UNIQUE CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[email_queue]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[email_queue](
	[id] [bigint] IDENTITY(4,1) NOT NULL,
	[subject] [varchar](50) NULL,
	[body] [varchar](max) NULL,
	[el_email] [varchar](100) NULL,
	[name] [varchar](100) NULL,
	[timestamp] [bigint] NULL,
	[reply_to] [varchar](100) NULL,
	[sended_from] [varchar](100) NULL,
	[sended_from_name] [varchar](100) NULL,
	[retries] [smallint] NULL,
 CONSTRAINT [PK_email_queue_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[email_headers_tickets]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[email_headers_tickets](
	[tickets_id] [bigint] NOT NULL,
	[tickets_header] [varchar](1500) NOT NULL,
 CONSTRAINT [PK_email_headers_tickets_tickets_id] PRIMARY KEY CLUSTERED 
(
	[tickets_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[contenidos]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[contenidos](
	[newsid] [bigint] IDENTITY(10,1) NOT NULL,
	[catalogid] [bigint] NULL,
	[es_principal] [smallint] NULL,
	[title] [varchar](255) NOT NULL,
	[descripcion] [varchar](max) NULL,
	[tipo_texto1] [varchar](5) NULL,
	[content1] [varchar](max) NULL,
	[picture1] [varchar](255) NULL,
	[alineado1] [varchar](6) NULL,
	[viewnum] [bigint] NULL,
	[adddate] [datetime2](0) NULL,
	[rating] [real] NULL,
	[ratenum] [bigint] NULL,
	[sourceurl] [varchar](100) NULL,
	[isdisplay] [smallint] NOT NULL,
	[adelante] [varchar](255) NULL,
	[atras] [varchar](255) NULL,
	[source] [varchar](50) NULL,
	[autor] [varchar](63) NULL,
	[source_main] [varchar](100) NULL,
	[leidas] [bigint] NULL,
	[keywords] [varchar](255) NULL,
	[isphp] [smallint] NULL,
	[blockip] [smallint] NULL,
 CONSTRAINT [PK_contenidos_newsid] PRIMARY KEY CLUSTERED 
(
	[newsid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE NONCLUSTERED INDEX [catalogid] ON [dbo].[contenidos] 
(
	[catalogid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[comments_articles]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[comments_articles](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [varchar](20) NULL,
	[child_article] [int] NULL,
	[area] [varchar](max) NULL,
	[moment] [int] NULL,
	[ip] [varchar](15) NULL,
	[email] [varchar](50) NULL,
	[website] [varchar](40) NULL,
 CONSTRAINT [comments_articles$id] UNIQUE CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[category]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[category](
	[categoryid] [int] IDENTITY(1,1) NOT NULL,
	[categoryname] [varchar](100) NOT NULL,
	[entrydate] [datetime2](0) NULL,
	[keyview] [varchar](6) NULL,
 CONSTRAINT [PK_category_categoryid] PRIMARY KEY CLUSTERED 
(
	[categoryid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[catalog]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[catalog](
	[catalogid] [bigint] IDENTITY(14,1) NOT NULL,
	[catalogname] [varchar](255) NOT NULL,
	[description] [varchar](max) NULL,
	[parentid] [bigint] NOT NULL,
 CONSTRAINT [PK_catalog_catalogid] PRIMARY KEY CLUSTERED 
(
	[catalogid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[canned_replies]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[canned_replies](
	[id] [smallint] IDENTITY(1,1) NOT NULL,
	[dep] [smallint] NULL,
	[subjet] [varchar](40) NULL,
	[body] [varchar](max) NULL,
 CONSTRAINT [PK_canned_replies_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[ban_emails]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ban_emails](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[email] [varchar](100) NULL,
 CONSTRAINT [PK_ban_emails_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY],
 CONSTRAINT [ban_emails$id] UNIQUE NONCLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[album]    Script Date: 04/29/2010 13:35:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[album](
	[id] [int] IDENTITY(3,1) NOT NULL,
	[artist] [varchar](100) NOT NULL,
	[title] [varchar](100) NOT NULL,
 CONSTRAINT [PK_album_id] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Default [DF__users_staf__user__76969D2E]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users_staff] ADD  DEFAULT (NULL) FOR [userx]
GO
/****** Object:  Default [DF__users_sta__depar__778AC167]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users_staff] ADD  DEFAULT (NULL) FOR [departament]
GO
/****** Object:  Default [DF__users_sta__depar__787EE5A0]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users_staff] ADD  DEFAULT (NULL) FOR [departament_visible]
GO
/****** Object:  Default [DF__users__name__6B24EA82]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT ('') FOR [name]
GO
/****** Object:  Default [DF__users__username__6C190EBB]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT ('') FOR [username]
GO
/****** Object:  Default [DF__users__password__6D0D32F4]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT ('') FOR [password]
GO
/****** Object:  Default [DF__users__email__6E01572D]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT ('') FOR [email]
GO
/****** Object:  Default [DF__users__lastlogin__6EF57B66]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [lastlogin]
GO
/****** Object:  Default [DF__users__newlogin__6FE99F9F]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [newlogin]
GO
/****** Object:  Default [DF__users__admin__70DDC3D8]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT ('') FOR [admin]
GO
/****** Object:  Default [DF__users__status__71D1E811]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT ('0') FOR [status]
GO
/****** Object:  Default [DF__users__added__72C60C4A]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [added]
GO
/****** Object:  Default [DF__users__company__73BA3083]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [company]
GO
/****** Object:  Default [DF__users__website__74AE54BC]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[users] ADD  DEFAULT (NULL) FOR [website]
GO
/****** Object:  Default [DF__tracking__ticket__66603565]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tracking] ADD  DEFAULT (NULL) FOR [ticket_id]
GO
/****** Object:  Default [DF__tracking__staff__6754599E]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tracking] ADD  DEFAULT (NULL) FOR [staff]
GO
/****** Object:  Default [DF__tracking__action__68487DD7]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tracking] ADD  DEFAULT (NULL) FOR [action]
GO
/****** Object:  Default [DF__tracking__tdate__693CA210]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tracking] ADD  DEFAULT (NULL) FOR [tdate]
GO
/****** Object:  Default [DF__tickets_t__ticke__5812160E]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('') FOR [tickets_username]
GO
/****** Object:  Default [DF__tickets_t__ticke__59063A47]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('') FOR [tickets_subject]
GO
/****** Object:  Default [DF__tickets_t__ticke__59FA5E80]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('0') FOR [tickets_timestamp]
GO
/****** Object:  Default [DF__tickets_t__ticke__5AEE82B9]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('') FOR [tickets_name]
GO
/****** Object:  Default [DF__tickets_t__ticke__5BE2A6F2]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('') FOR [tickets_email]
GO
/****** Object:  Default [DF__tickets_t__ticke__5CD6CB2B]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('1') FOR [tickets_urgency]
GO
/****** Object:  Default [DF__tickets_t__ticke__5DCAEF64]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('1') FOR [tickets_category]
GO
/****** Object:  Default [DF__tickets_t__ticke__5EBF139D]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('Client') FOR [tickets_admin]
GO
/****** Object:  Default [DF__tickets_t__ticke__5FB337D6]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('0') FOR [tickets_child]
GO
/****** Object:  Default [DF__tickets_t__unrea__60A75C0F]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('1') FOR [unread_admin]
GO
/****** Object:  Default [DF__tickets_t__unrea__619B8048]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT (NULL) FOR [unread_user]
GO
/****** Object:  Default [DF__tickets_t__previ__628FA481]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT (NULL) FOR [previous]
GO
/****** Object:  Default [DF__tickets_tic__eta__6383C8BA]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT (NULL) FOR [eta]
GO
/****** Object:  Default [DF__tickets_t__reser__6477ECF3]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_tickets] ADD  DEFAULT ('') FOR [reserved]
GO
/****** Object:  Default [DF__tickets_stat__id__4F7CD00D]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT (NULL) FOR [id]
GO
/****** Object:  Default [DF__tickets_s__close__5070F446]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT (NULL) FOR [closed_by]
GO
/****** Object:  Default [DF__tickets_s__opene__5165187F]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT (NULL) FOR [opened_by]
GO
/****** Object:  Default [DF__tickets_s__hold___52593CB8]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT (NULL) FOR [hold_by]
GO
/****** Object:  Default [DF__tickets_s__ticke__534D60F1]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT ('1') FOR [tickets_status]
GO
/****** Object:  Default [DF__tickets_s__assig__5441852A]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT (NULL) FOR [assigned]
GO
/****** Object:  Default [DF__tickets_s__assig__5535A963]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT (NULL) FOR [assigned_to]
GO
/****** Object:  Default [DF__tickets_s__keyvi__5629CD9C]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_state] ADD  DEFAULT (NULL) FOR [keyview]
GO
/****** Object:  Default [DF__tickets_poll__id__46E78A0C]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [id]
GO
/****** Object:  Default [DF__tickets_poll__a__47DBAE45]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [a]
GO
/****** Object:  Default [DF__tickets_poll__b__48CFD27E]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [b]
GO
/****** Object:  Default [DF__tickets_poll__c__49C3F6B7]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [c]
GO
/****** Object:  Default [DF__tickets_poll__d__4AB81AF0]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [d]
GO
/****** Object:  Default [DF__tickets_poll__e__4BAC3F29]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [e]
GO
/****** Object:  Default [DF__tickets_p__times__4CA06362]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [timestamp]
GO
/****** Object:  Default [DF__tickets_p__staff__4D94879B]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_poll] ADD  DEFAULT (NULL) FOR [staff]
GO
/****** Object:  Default [DF__tickets_le__name__4316F928]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_levels] ADD  DEFAULT ('') FOR [name]
GO
/****** Object:  Default [DF__tickets_l__order__440B1D61]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_levels] ADD  DEFAULT ('1') FOR [orderx]
GO
/****** Object:  Default [DF__tickets_l__color__44FF419A]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_levels] ADD  DEFAULT ('') FOR [color]
GO
/****** Object:  Default [DF__tickets_c__ticke__3A81B327]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT ('') FOR [tickets_categories_name]
GO
/****** Object:  Default [DF__tickets_c__ticke__3B75D760]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT ('1') FOR [tickets_categories_order]
GO
/****** Object:  Default [DF__tickets_c__email__3C69FB99]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT (NULL) FOR [email]
GO
/****** Object:  Default [DF__tickets_c__passw__3D5E1FD2]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT (NULL) FOR [password]
GO
/****** Object:  Default [DF__tickets_c__epipi__3E52440B]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT (NULL) FOR [epiping]
GO
/****** Object:  Default [DF__tickets_c__email__3F466844]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT (NULL) FOR [emailpiping]
GO
/****** Object:  Default [DF__tickets_c__maxfi__403A8C7D]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT (NULL) FOR [maxfile]
GO
/****** Object:  Default [DF__tickets_cat__sms__412EB0B6]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_categories] ADD  DEFAULT (NULL) FOR [sms]
GO
/****** Object:  Default [DF__tickets_a__ticke__36B12243]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_atach] ADD  DEFAULT ('0') FOR [tickets_id]
GO
/****** Object:  Default [DF__tickets_a__atach__37A5467C]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_atach] ADD  DEFAULT ('') FOR [atachmen]
GO
/****** Object:  Default [DF__tickets_a__atach__38996AB5]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[tickets_atach] ADD  DEFAULT (NULL) FOR [atachmen_new]
GO
/****** Object:  Default [DF__spam__filter__33D4B598]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[spam] ADD  DEFAULT (NULL) FOR [filter]
GO
/****** Object:  Default [DF__spam__deletespam__34C8D9D1]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[spam] ADD  DEFAULT (NULL) FOR [deletespam]
GO
/****** Object:  Default [DF__error_log__actio__300424B4]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[error_log] ADD  DEFAULT (NULL) FOR [action]
GO
/****** Object:  Default [DF__error_log__times__30F848ED]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[error_log] ADD  DEFAULT (NULL) FOR [timestamp]
GO
/****** Object:  Default [DF__error_log__delay__31EC6D26]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[error_log] ADD  DEFAULT (NULL) FOR [delay]
GO
/****** Object:  Default [DF__email_que__subje__276EDEB3]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [subject]
GO
/****** Object:  Default [DF__email_que__el_em__286302EC]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [el_email]
GO
/****** Object:  Default [DF__email_queu__name__29572725]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [name]
GO
/****** Object:  Default [DF__email_que__times__2A4B4B5E]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [timestamp]
GO
/****** Object:  Default [DF__email_que__reply__2B3F6F97]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [reply_to]
GO
/****** Object:  Default [DF__email_que__sende__2C3393D0]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [sended_from]
GO
/****** Object:  Default [DF__email_que__sende__2D27B809]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [sended_from_name]
GO
/****** Object:  Default [DF__email_que__retri__2E1BDC42]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[email_queue] ADD  DEFAULT (NULL) FOR [retries]
GO
/****** Object:  Default [DF__contenido__catal__117F9D94]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [catalogid]
GO
/****** Object:  Default [DF__contenido__es_pr__1273C1CD]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [es_principal]
GO
/****** Object:  Default [DF__contenido__title__1367E606]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT ('') FOR [title]
GO
/****** Object:  Default [DF__contenido__tipo___145C0A3F]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [tipo_texto1]
GO
/****** Object:  Default [DF__contenido__pictu__15502E78]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [picture1]
GO
/****** Object:  Default [DF__contenido__aline__164452B1]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [alineado1]
GO
/****** Object:  Default [DF__contenido__viewn__173876EA]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [viewnum]
GO
/****** Object:  Default [DF__contenido__addda__182C9B23]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [adddate]
GO
/****** Object:  Default [DF__contenido__ratin__1920BF5C]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [rating]
GO
/****** Object:  Default [DF__contenido__raten__1A14E395]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [ratenum]
GO
/****** Object:  Default [DF__contenido__sourc__1B0907CE]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [sourceurl]
GO
/****** Object:  Default [DF__contenido__isdis__1BFD2C07]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT ('0') FOR [isdisplay]
GO
/****** Object:  Default [DF__contenido__adela__1CF15040]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [adelante]
GO
/****** Object:  Default [DF__contenido__atras__1DE57479]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [atras]
GO
/****** Object:  Default [DF__contenido__sourc__1ED998B2]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [source]
GO
/****** Object:  Default [DF__contenido__autor__1FCDBCEB]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [autor]
GO
/****** Object:  Default [DF__contenido__sourc__20C1E124]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [source_main]
GO
/****** Object:  Default [DF__contenido__leida__21B6055D]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [leidas]
GO
/****** Object:  Default [DF__contenido__keywo__22AA2996]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [keywords]
GO
/****** Object:  Default [DF__contenido__isphp__239E4DCF]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [isphp]
GO
/****** Object:  Default [DF__contenido__block__24927208]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[contenidos] ADD  DEFAULT (NULL) FOR [blockip]
GO
/****** Object:  Default [DF__comments___usern__0AD2A005]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[comments_articles] ADD  DEFAULT (NULL) FOR [username]
GO
/****** Object:  Default [DF__comments___child__0BC6C43E]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[comments_articles] ADD  DEFAULT (NULL) FOR [child_article]
GO
/****** Object:  Default [DF__comments___momen__0CBAE877]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[comments_articles] ADD  DEFAULT (NULL) FOR [moment]
GO
/****** Object:  Default [DF__comments_art__ip__0DAF0CB0]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[comments_articles] ADD  DEFAULT (NULL) FOR [ip]
GO
/****** Object:  Default [DF__comments___email__0EA330E9]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[comments_articles] ADD  DEFAULT (NULL) FOR [email]
GO
/****** Object:  Default [DF__comments___websi__0F975522]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[comments_articles] ADD  DEFAULT (NULL) FOR [website]
GO
/****** Object:  Default [DF__category__catego__07020F21]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[category] ADD  DEFAULT ('') FOR [categoryname]
GO
/****** Object:  Default [DF__category__entryd__07F6335A]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[category] ADD  DEFAULT (NULL) FOR [entrydate]
GO
/****** Object:  Default [DF__category__keyvie__08EA5793]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[category] ADD  DEFAULT (NULL) FOR [keyview]
GO
/****** Object:  Default [DF__catalog__catalog__0425A276]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[catalog] ADD  DEFAULT ('') FOR [catalogname]
GO
/****** Object:  Default [DF__catalog__parenti__0519C6AF]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[catalog] ADD  DEFAULT ('0') FOR [parentid]
GO
/****** Object:  Default [DF__canned_repl__dep__014935CB]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[canned_replies] ADD  DEFAULT (NULL) FOR [dep]
GO
/****** Object:  Default [DF__canned_re__subje__023D5A04]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[canned_replies] ADD  DEFAULT (NULL) FOR [subjet]
GO
/****** Object:  Default [DF__ban_email__email__7F60ED59]    Script Date: 04/29/2010 13:35:46 ******/
ALTER TABLE [dbo].[ban_emails] ADD  DEFAULT (NULL) FOR [email]
GO
